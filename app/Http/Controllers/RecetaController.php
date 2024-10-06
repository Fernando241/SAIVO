<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecetaController extends Controller
{
    public function recetas(){
        return view('paginas.recetas');
    }
}
