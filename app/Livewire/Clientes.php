<?php

namespace App\Livewire;

use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;

class Clientes extends Component
{
    use WithPagination;

    public $search ='';
    public $clientes;

    public function mount()
    {
        // Cargar todos los clientes al iniciar
        $this->clientes = Cliente::all();
    }

    public function buscarClientes()
    {
        if ($this->search == '') 
        {
            $this->clientes = Cliente::all();
        } else {
            $this->clientes = Cliente::where('nombre', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                            ->get();
        }
    }

    public function render()
    {
        $cliente = Cliente::where('nombre', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('email', 'LIKE', '%' . $this->search . '%')->paginate();
        return view('livewire.clientes', compact('cliente'));
    }
}
