<?php

namespace App\Livewire;

use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;

class Proveedors extends Component
{
    use WithPagination;

    public $search = '';
    public $proveedores;

    public function buscarProveedores()
    {
        if ($this->search == '') {
            $this->proveedores = Proveedor::all();
        } else {
            $this->proveedores = Proveedor::where('nombre', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                            ->get();
        }
    }
    public function render()
    {
        $proveedor = Proveedor::where('nombre', 'LIKE', '%' . $this->search . '%')
        ->orWhere('email', 'LIKE', '%' . $this->search . '%')
        ->paginate();

        return view('livewire.proveedors', compact('proveedor'));
    }
}
