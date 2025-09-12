<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class inicioController extends Controller
{
    public function inicio(){
        $products = Producto::all();
        return view('paginas.inicio', compact('products'));
    }

    public function nosotros(){
        return view('paginas.nosotros');
    }

    public function AdminProducts()
    {
        $products = Producto::all();
        return view('products.adminProducts', compact('products'));
    }
    public function misDatos()
    {
        return view('misDatos');
    }
}
