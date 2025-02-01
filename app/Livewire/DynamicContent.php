<?php

namespace App\Livewire;

use Livewire\Component;

class DynamicContent extends Component
{

    public $currentTab = 'inicio'; /* esto define el contenido inicial a mostrar */

    public function switchTab($tab)
    {
        if ($tab === 'productos') {
            return redirect()->route('adminProducts');
        }
        $this->currentTab = $tab; 
    }
    public function render()
    {
        return view('livewire.dynamic-content');
    }
}
