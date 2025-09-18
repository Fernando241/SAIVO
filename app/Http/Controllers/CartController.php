<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\PedidoPagado;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Mail\BienvenidaCliente;
use App\Mail\ConfirmacionPago;
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
    
    /* ------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function procesarPedido(Request $request)
{
    $cliente = session()->get('cliente');
    $cart = session()->get('cart', []);
    $total = array_reduce($cart, function ($carry, $item) {
        return $carry + ($item['quantity'] * $item['price']);
    }, 0);

    // Crear el pedido
    $pedido = Pedido::create([
        'cliente_id' => $cliente->id,
        'total' => $total,
        'estado' => 'Pendiente', 
    ]);

    // Crear los detalles del pedido
    foreach ($cart as $item) {
        DetallePedido::create([
            'pedido_id' => $pedido->id,
            'producto_id' => $item['id'],
            'cantidad' => $item['quantity'],
            'precio' => $item['price'],
        ]);
    }

    // Limpiar el carrito
    session()->forget('cart');
    session()->forget('cliente'); //limpiar el cliente de la sesion tambien.

    // Disparar el evento ¿se puede remplazar por un envio de correo?
    /* event(new PedidoPagado($pedido, $cliente)); */
    Mail::to($cliente->email)->send(new ConfirmacionPago($cliente, $pedido));

    return response()->json(['success' => true]);
}

}
