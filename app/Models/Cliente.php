<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Agregar este campo
        'nombre',
        'email',
        'telefono',
        'direccion',
    ];

    // Relación con Pedido
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'cliente_id');
    }
}
