<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedido;
use Livewire\WithPagination;


class Pedidos extends Component
{
    use WithPagination;

    public $search = '';
    public $pedidos;
    

    public function mount()
    {
        // Cargar todos los pedidos al iniciar
        $this->pedidos = Pedido::all();
    }

    public function buscarPedidos()
    {
        if ($this->search == '') {
            $this->pedidos = Pedido::all();
        } else {
            $this->pedidos = Pedido::where('created_at', 'LIKE', '%' . $this->search. '%')
                ->orWhere('cliente_id', 'LIKE', '%' . $this->search. '%')
                ->get();
        }
    }
    public function render()
{
    $pedido = Pedido::with('cliente')
        ->where('id', 'LIKE', '%'.$this->search.'%')
        ->orWhere('cliente_id', 'LIKE', '%'.$this->search.'%')
        ->paginate();

    return view('livewire.pedidos', compact('pedido'));
}

}
