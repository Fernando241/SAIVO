<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'presentacion',
        'componentes',
        'descripcion',
        'indicaciones',
        'contraindicaciones',
        'stock',
        'precio_compra',
        'precio_venta',
        'imagen',
    ];
}
