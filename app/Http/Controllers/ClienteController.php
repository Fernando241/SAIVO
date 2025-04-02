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
}
