<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;

class ProductsEdit extends Component
{
    public $product;
    public function mount(Producto $product)
    {
        $this->product = $product;
    }
    public function render()
    {
        return view('livewire.products-edit');
    }
}
