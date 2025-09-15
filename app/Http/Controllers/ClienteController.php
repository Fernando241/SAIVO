<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('clientes.index');
    }


    public function show($id)
    {
        $cliente = Cliente::find($id);
        $pedidos = Pedido::where('cliente_id', $id)->get();
        return view('clientes.show', compact('cliente', 'pedidos'));
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:12',
            'direccion' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);

        $cliente = Cliente::find($id);
        $cliente->nombre = $request->input('nombre');
        $cliente->telefono = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->email = $request->input('email');

        $cliente->save();

        return redirect()->route('misDatos')->with('success', 'Datos actualizados con éxito!');
    }
}
