<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;

class BusquedaProductos extends Component
{
    public $query = ''; // Variable para la búsqueda
    public $productos = []; // Almacenar resultados

    public function updatedQuery()
    {
        $this->productos = Producto::where('nombre', 'LIKE', "%{$this->query}%")->get();
    }

    public function render()
    {
        return view('livewire.busqueda-productos');
    }
}
