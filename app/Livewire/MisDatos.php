<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;

class MisDatos extends Component
{
    public $cliente;

    public function mount()
    {
        $user = Auth::user();
        $this->cliente = Cliente::where('user_id', $user->id)->first();
    }

    public function render()
    {
        return view('livewire.mis-datos');
    }
}
