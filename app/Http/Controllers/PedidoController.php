<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Producto; // ya se revisa si sobra
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
    // Obtengo los datos desde la sesión
        $cliente = Session::get('cliente');
        $cart = Session::get('cart', []);
        $total = array_reduce($cart, function ($carry, $item) {
        return $carry + ($item['quantity'] * $item['price']);
        }, 0);

    // Iniciar transacción de base de datos para asegurar la integridad
        DB::beginTransaction();

        try {
        // Crear el pedido
            $pedido = Pedido::create([
                'cliente_id' => $cliente->id,
                'total' => $total,
                'estado' => 'Pendiente',
            ]);
        

        // Crear detalles del pedido
            foreach ($cart as $item) {
                DetallePedido::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $item['id'],
                    'cantidad' => $item['quantity'],
                    'precio' => $item['price'],
                    'created_at' => now(),
                ]);
            }
        // Eliminar los productos del carrito
            Session::forget('cart');

        // Confirmar la transacción
            DB::commit();

        // Redirigir al listado de pedidos
            return redirect()->route('inicio')->with('success', 'Su pago y pedido han sido exitosos');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Hubo un error al procesar su pago y pedido. Inténtalo de nuevo.');
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
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return redirect()->back()->with('error', 'Pedido no encontrado.');
        }

        DB::beginTransaction();

        try{
            $pedido->estado = $request->estado;
            $pedido->save();

            // Descuento del stock solo si el estado se cambia a "Enviado"
            if($request->estado === 'Enviado') {
                foreach($pedido->detalles as $detalle) {
                    $producto = $detalle->producto;
                    $producto->stock -= $detalle->cantidad;

                    if($producto->stock < 0) {
                        throw new \Exception('No hay stock suficiente para enviar el pedido.');
                    }

                    $producto->save();
                }
            }
            // confirmo la transacción
            DB::commit();
            return redirect()->route('pedidos.index')->with('success', 'El estado del pedido ha sido actualizado.');
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Hubo un error al actualizar el estado del pedido.');
        }

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
