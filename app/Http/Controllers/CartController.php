<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

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
                "name" => $product->nombre,
                "quantity" => 1,
                "price" => $product->precio_venta,
                "image" => $product->imagen,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    // Mostrar el carrito
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

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

    //Limpiar carrito
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('productos.index')->with('success', 'Carrito vaciado');
    }

    // Finalizar compra
    public function checkout()
    {
        // Lógica para finalizar la compra

        // Vaciar el carrito después de la compra
        session()->forget('cart');
        return redirect()->route('productos.index')->with('success', 'Compra finalizada con éxito');
    }
}
