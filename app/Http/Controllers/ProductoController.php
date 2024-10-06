<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function productos(){
        return view('paginas.productos');
    }
}
