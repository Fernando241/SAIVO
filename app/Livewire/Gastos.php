<?php

namespace App\Livewire;

use App\Models\Gasto;
use Livewire\Component;
use Livewire\WithPagination;

class Gastos extends Component
{
    use WithPagination;

    public $search = '';
    public $gastos;

    public function mount()
    {
        $this->gastos = Gasto::all();
    }

    public function buscarGastos()
    {
        if($this->search == '')
        {
            $this->gastos = Gasto::all();
        } else {
            $this->gastos = Gasto::where('descripcion', 'LIKE', '%' . $this->search . '%')
            ->get();
        }
    }
    public function render()
    {
        $gastos = Gasto::where('descripcion', 'LIKE', '%' . $this->search . '%')
        ->paginate();
        return view('livewire.gastos', compact('gastos'));
    }
}
