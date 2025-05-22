<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    protected $fillable = [
        'id',
        'valor',
        'descripcion',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
