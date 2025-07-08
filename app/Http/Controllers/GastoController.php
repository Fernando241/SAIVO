<?php

namespace App\Http\Controllers;

use App\Livewire\Proveedors;
use App\Models\Gasto;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gasto = Gasto::all();
        return view('gastos.index', compact('gasto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        return view('gastos.create', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validación de datos
        $request->validate([
            'valor' => 'required|numeric',
            'descripcion' => 'required|string|max:255',
            'proveedor_id' => 'required|exists:proveedors,id',
        ]);
        //crear un nuevo gasto
        Gasto::create($request->all());
        return redirect()->route('gastos.index')->with('success', 'Nuevo gasto agregado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gasto $gasto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gastos = Gasto::find($id);
        $proveedores = Proveedor::all();
        return view('gastos.edit', compact('gastos', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gasto $gasto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gasto $gasto)
    {
        //
    }
}
