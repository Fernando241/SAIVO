<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    // Finalizar compra
        public function checkout()
    {
        $user = Auth::user();
        $cliente = null;

        if ($user) {
            // Buscar al cliente por su user_id o email
            $cliente = Cliente::where('user_id', $user->id)->orWhere('email', $user->email)->first();
        }

        return view('cart.checkoutForm', compact('user', 'cliente'));
    }
    /* ------------------------------------------------------------------------------------------------------------------------------------------------- */
    // verificar compra
        public function revisar(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ]);

        // Verificar si el cliente ya existe por email
        $cliente = Cliente::where('email', $validated['email'])->first();

        if (!$cliente) {
            // Si no existe, crearlo
            $cliente = Cliente::create([
                'user_id' => Auth::id(), // Si el usuario está autenticado, guarda su ID
                'nombre' => $validated['nombre'],
                'telefono' => $validated['telefono'],
                'direccion' => $validated['direccion'],
                'email' => $validated['email']
            ]);
        }

        // Guardar el cliente en la sesión
        session()->put('cliente', $cliente);

        // Obtener el carrito desde la sesión
        $cart = session()->get('cart', []);

        if (empty($cart)) {
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
        return redirect()->route('checkout.summary');
    }

    /* ------------------------------------------------------------------------------------------------------------------------------------------------- */
        public function checkoutSummary(Request $request)
    {
        // Verificar si los datos del cliente ya están en la sesión
        if (!session()->has('cliente')) {
            // Obtener datos del formulario o sesión (según cómo estés manejando los datos)
            $clienteData = $request->only(['nombre', 'telefono', 'direccion']);
    
            // Verificar si el cliente ya existe en la base de datos
            $cliente = Cliente::where('telefono', $clienteData['telefono'])->first();
    
            // Si no existe, guardarlo en la base de datos
            if (!$cliente) {
                $cliente = Cliente::create($clienteData);
            }
    
            // Guardar cliente en la sesión
            session()->put('cliente', $cliente);
        } else {
            // Si el cliente ya está en sesión, lo recuperamos
            $cliente = session()->get('cliente');
        }
    
        // Obtener el carrito de compras desde la sesión
        $cart = session()->get('cart', []);

        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['quantity'] * $item['price']);
        }, 0);
        
        return view('cart.checkoutSummary', compact('cliente', 'cart', 'total'));
    }
    

    /* ------------------------------------------------------------------------------------------------------------------------------------------------- */

    
}
