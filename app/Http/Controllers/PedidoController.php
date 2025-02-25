<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pedidos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validar los datos del pedido
    $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'total' => 'required|numeric',
        'productos' => 'required|array', // Validar que los productos se envían como un array
        'productos.*.id' => 'required|exists:productos,id', // Validar que cada producto tenga un ID válido
        'productos.*.cantidad' => 'required|integer|min:1', // Validar la cantidad de cada producto
        'productos.*.precio' => 'required|numeric', // Validar el precio de cada producto
    ]);

    DB::beginTransaction();
    try {
        // Crear el pedido
        $pedido = Pedido::create([
            'cliente_id' => $request->cliente_id,
            'total' => $request->total,
            'estado' => 'Pendiente',
        ]);

        // Guardar los productos en DetallePedido
        foreach ($request->productos as $producto) {
            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $producto['id'],
                'cantidad' => $producto['cantidad'],
                'precio' => $producto['precio'],
            ]);
        }

        // Vaciar el carrito después de finalizar la compra
        session()->forget('cart');

        DB::commit();
        return redirect()->route('inicio')->with('success', 'Pedido registrado con éxito.');

    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'Error al procesar el pedido. Inténtalo de nuevo.');
    }
}



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pedido = Pedido::with('detalles.producto')->find($id);
        $producto = Producto::all();
    
        return view('pedidos.show', compact('pedido', 'producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
