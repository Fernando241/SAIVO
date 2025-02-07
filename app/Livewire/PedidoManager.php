<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedido;
use Livewire\WithPagination;

class PedidoManager extends Component
{
    use WithPagination;

    public $filtroEstado = '';

    // Escuchar eventos en tiempo real
    protected $listeners = ['pedidoCreado' => 'render'];

    // Método para cambiar el estado del pedido
    public function cambiarEstado($id, $nuevoEstado)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->estado = $nuevoEstado;
        $pedido->save();

        // Emitir evento para actualizar en tiempo real
        $this->emit('pedidoActualizado');
    }

    // Renderizar la vista con pedidos filtrados
    public function render()
    {
        $pedidos = Pedido::when($this->filtroEstado, function ($query) {
            $query->where('estado', $this->filtroEstado);
        })->latest()->paginate(5);

        return view('livewire.pedido-manager', compact('pedidos'));
    }
}


