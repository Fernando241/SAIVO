<?php

namespace App\Livewire;

use Livewire\Component;

class DynamicContent extends Component
{

    public $currentRoute;

    public function mount()
    {
        $this->currentRoute = request()->route()->getName(); // Obtiene la ruta actual
    }

    
    public function render()
    {
        return view('livewire.dynamic-content');
    }
}
