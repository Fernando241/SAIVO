<?php

namespace App\Livewire;

use Livewire\Component;

class DynamicContent extends Component
{

    public $currentTab = 'inicio'; /* esto define el contenido inicial a mostrar */

    public function switchTab($tab)
    {
        $this->currentTab = $tab; /* este metodo cambia el contenido mostrado segun la pestaña clickeada */
    }
    public function render()
    {
        return view('livewire.dynamic-content');
    }
}
