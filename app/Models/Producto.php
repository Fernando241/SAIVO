<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cocur\Slugify\Slugify;

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
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($producto) {
            $slugify = new Slugify();
            $producto->slug = $slugify->slugify($producto->nombre);
        });

        static::updating(function ($producto) {
            $slugify = new Slugify();
            $producto->slug = $slugify->slugify($producto->nombre);
        });
    }

    // Para que Laravel busque por slug en lugar de id
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /* public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'producto_id');
    } */
    public function detalles() // Cambiado de pedidos() a detalles()
    {
        return $this->hasMany(DetallePedido::class, 'producto_id');
    }
}