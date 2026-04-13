<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\User;
use Illuminate\Support\Facades\Hash;


use App\Mail\BienvenidaCliente;
use App\Mail\ConfirmacionPago;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;



class CartController extends Controller
{
    // Agregar productos al carrito
    public function addToCart(Request $request, $productId)
    {
        $product = Producto::find($productId);
        $cart = session()->get('cart', []);
        
        if (!$product) {
            return redirect()->back()->with('error', 'Producto no encontrado');
        }

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                "id" => $product->id, //agregue esta linea para estar pendiente por si no funciona
                "name" => $product->nombre,
                "quantity" => 1,
                "price" => $product->precio_venta,
                "image" => $product->imagen,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }
    /* ------------------------------------------------------------------------------------------------------------------------------------------------- */
    // Mostrar el carrito
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }
    /* ------------------------------------------------------------------------------------------------------------------------------------------------- */
    // Editar cantidad
    public function updateCart(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Cantidad actualizada');
        }

        return redirect()->back()->with('error', 'Producto no encontrado en el carrito');
    }
    /* ------------------------------------------------------------------------------------------------------------------------------------------------- */
    // Eliminar producto
    public function removeProduct(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Producto eliminado del carrito');
        }

        return redirect()->back()->with('error', 'Producto no encontrado en el carrito');
    }
    /* ------------------------------------------------------------------------------------------------------------------------------------------------- */
    // Obtener el total del carrito
    public function getTotalItemsInCart()
    {
        $cart = session()->get('cart', []);
        $totalItems = 0;

        foreach ($cart as $item) {
            $totalItems += $item['quantity'];
        }

        return $totalItems;
    }
    /* ------------------------------------------------------------------------------------------------------------------------------------------------- */
    //Limpiar carrito
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('productos.index')->with('success', 'Carrito vaciado');
    }
    /* ------------------------------------------------------------------------------------------------------------------------------------------------- */
    // Rescatar datos del cliente si esta registrado para enviarlos a la vista SaveDatasClient
        public function AddDatasClient()
    {
        $user = Auth::user();
        $cliente = null;

        if ($user) {
            // Buscar al cliente por su user_id o email
            $cliente = Cliente::where('user_id', $user->id)->orWhere('email', $user->email)->first();
        }

        return view('cart.SaveDatasClient', compact('user', 'cliente'));
    }
    /* ------------------------------------------------------------------------------------------------------------------------------------------------- */
    // Guardar Cliente en la base de datos si no existe
        public function SaveDatasClient(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ]);

        //-----------------------------------------------------
        // Buscar usuario por email
        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            // Crear el usuario sin requerir verificación
            $user = User::create([
                'name' => $validated['nombre'],
                'email' => $validated['email'],
                'password' => Hash::make('SaludNatural'), // password temporal o aleatorio
                'email_verified_at' => now(), // Marcar como verificado directamente
            ]);

            // Asignar el rol Cliente
            $user->assignRole('Cliente');

            Mail::to($user->email)->send(new BienvenidaCliente($user->name, $user->email));
        }

        //-------------------------------------------------------
        // Verificar si el cliente ya existe por email
        $cliente = Cliente::where('email', $validated['email'])->first();

        if (!$cliente) {
            // Si no existe, crearlo
            $cliente = Cliente::create([
                'user_id' => $user->id, // Si el usuario está autenticado, guarda su ID
                'nombre' => $validated['nombre'],
                'telefono' => $validated['telefono'],
                'direccion' => $validated['direccion'],
                'email' => $validated['email']
            ]);
        } else {
            $cliente->update([
                'nombre' => $validated['nombre'],
                'telefono' => $validated['telefono'],
                'direccion' => $validated['direccion'],
                'user_id' => $user->id
            ]);
        }

        // Guardar el cliente en la sesión
        session()->put('cliente', $cliente);

        // Obtener el carrito desde la sesión
        $cart = session()->get('cart', []);

        if (empty($cart)) { /* esta parte la coloque por si acaso pero realmente no se necesita ya que por mi lógica no se puede llegar hasta este punto si el carrito esta vacio */
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        // Preparar resumen del pedido 
        $pedidoResumen = [
            'productos' => $cart,
            'total' => array_reduce($cart, function ($carry, $item) {
                return $carry + ($item['quantity'] * $item['price']);
            }, 0),
        ];

        // Guardar en sesión para pasarlo a la siguiente vista
        session()->put('pedidoResumen', $pedidoResumen);

        // Redirigir a la vista del resumen del pedido
        return redirect()->route('cart.displayOrderData');
    }

    /* ------------------------------------------------------------------------------------------------------------------------------------------------- */
        public function displayOrderData(Request $request)
    {
        // Verificar si los datos del cliente ya están en la sesión
        $cliente = session()->get('cliente');
        
    
        // Obtener el carrito de compras desde la sesión
        $cart = session()->get('cart', []);

        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['quantity'] * $item['price']);
        }, 0);
        
        return view('cart.DisplayOrderData', compact('cliente', 'cart', 'total'));
    }
    
    public function pagosTemporales()
    {
        // Obtener el ID del pedido recién creado
        $pedidoId = session()->get('pedido_id');

        if (!$pedidoId) {
            return redirect()->route('productos.index')
                ->with('error', 'No hay un pedido en proceso.');
        }

        // Cargar el pedido con sus relaciones
        $pedido = Pedido::with(['cliente', 'detalles.producto'])->findOrFail($pedidoId);

        // Cliente desde la relación
        $cliente = $pedido->cliente;

        // Detalles del pedido
        $cart = $pedido->detalles; // equivalente a tu $cart anterior

        // Total registrado en DB
        $total = $pedido->total;

        return view('cart.PagosTemporales', compact('cliente', 'cart', 'total', 'pedido'));
    }

    /* -------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* Función Temporal para crear pedido mientras se activa Wompi) */
    public function crearPedido(Request $request)
    {
        $cliente = session()->get('cliente');
        $cart = session()->get('cart', []);

        // 1. Validaciones (IGUAL QUE ANTES)
        if (!$cliente || empty($cart)) {
            return response()->json(['error' => 'Error'], 400);
        }

        // 2. CREAR EL PEDIDO (Usando transacciones para mayor seguridad)
        $pedido = DB::transaction(function () use ($cliente, $cart) {
            $total = array_reduce($cart, function ($carry, $item) {
                return $carry + ($item['quantity'] * $item['price']);
            }, 0);

            $subtotal = round($total / 1.19, 2);
            $iva = round($total - $subtotal, 2);

            $p = Pedido::create([
                'cliente_id' => $cliente->id,
                'subtotal' => $subtotal,
                'iva' => $iva,
                'total' => $total,
                'estado' => 'Pendiente_pago',
            ]);

            foreach ($cart as $item) {
                DetallePedido::create([
                    'pedido_id' => $p->id,
                    'producto_id' => $item['id'],
                    'cantidad' => $item['quantity'],
                    'precio' => $item['price'],
                ]);
            }
            return $p;
        });

        // 3. ENVIAR EL CORREO *** ANTES *** DE LIMPIAR NADA
        try {
            // Asegúrate de pasar el objeto $cliente que recuperamos al inicio
            Mail::to($cliente->email)->send(new ConfirmacionPago($cliente, $pedido));
        } catch (\Exception $e) {
            Log::error('Error enviando a Zoho: ' . $e->getMessage());
        }

        // 4. GUARDAR EL ID PARA LA VISTA FINAL
        session()->put('pedido_id', $pedido->id);

        // 5. LIMPIAR SESIÓN AL FINAL DE TODO
        session()->forget('cart');
        session()->forget('cliente'); 

        return response()->json([
            'success' => true,
            'pedido_id' => $pedido->id
        ]);
    }

    /* -------------------------------Desde aqui nueva implementación de Wompi | preparación -------------------------------------------- */

    /* Controlador pagos Wompi */
    public function wompiResponse(Request $request)
    {
        // Wompi puede enviar datos por query params
        $reference = $request->input('reference');

        if (!$reference) {
            return redirect()->route('productos.index')
                ->with('error', 'Referencia de pago no encontrada.');
        }

        // Extraer ID del pedido (ej: PEDIDO_15 → 15)
        $pedidoId = str_replace('PEDIDO_', '', $reference);

        $pedido = Pedido::find($pedidoId);

        if (!$pedido) {
            return redirect()->route('productos.index')
                ->with('error', 'Pedido no encontrado.');
        }

        // ⚠️ Aún NO confirmamos pago aquí
        return view('cart.wompi_response', compact('pedido'));
    }

    public function wompiWebhook(Request $request)
    {
        Log::info('Webhook Wompi recibido', $request->all());

        $data = $request->input('data');

        if (!$data) {
            return response()->json(['error' => 'No data'], 400);
        }

        $transaction = $data['transaction'] ?? null;

        if (!$transaction) {
            return response()->json(['error' => 'No transaction'], 400);
        }

        $reference = $transaction['reference'] ?? null;
        $status = $transaction['status'] ?? null;

        if (!$reference || !$status) {
            return response()->json(['error' => 'Datos incompletos'], 400);
        }

        // Extraer ID pedido
        $pedidoId = str_replace('PEDIDO_', '', $reference);

        $pedido = Pedido::find($pedidoId);

        if (!$pedido) {
            return response()->json(['error' => 'Pedido no encontrado'], 404);
        }

        // 🔥 LÓGICA CLAVE
        if ($status === 'APPROVED') {
            $pedido->estado = 'Pagado';
        } elseif ($status === 'DECLINED' || $status === 'ERROR') {
            $pedido->estado = 'Fallido';
        }

        $pedido->save();

        return response()->json(['success' => true]);
    }

    public function wompiCheckout($pedidoId)
    {
        $pedido = Pedido::with(['cliente', 'detalles.producto'])->find($pedidoId);

        if (!$pedido) {
            return redirect()->route('productos.index')
                ->with('error', 'Pedido no encontrado.');
        }

        // ⚠️ Validación básica
        if ($pedido->estado !== 'Pendiente_pago') {
            return redirect()->route('productos.index')
                ->with('error', 'Este pedido ya fue procesado.');
        }

        // 🔥 Aquí luego irá integración real con Wompi

        return view('cart.wompi_checkout', compact('pedido'));
    }

}
