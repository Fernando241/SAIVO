<?php

namespace App\Livewire;

use App\Models\Producto;
use Carbon\Carbon;
use Livewire\Component;

class InventoryDashboard extends Component
{
    public $productos;

    public function mount()
    {
        $hoy = Carbon::today();
        $semana = Carbon::now()->startOfWeek();
        $mes = Carbon::now()->startOfMonth();

        $this->productos = Producto::select('id', 'nombre', 'stock')
            ->withCount(['detalles as ventas_hoy' => function ($query) use ($hoy) {
                $query->whereHas('pedido', function ($query) use ($hoy) {
                    $query->whereDate('created_at', $hoy);
                });
            }])
            ->withCount(['detalles as ventas_semana' => function ($query) use ($semana) {
                $query->whereHas('pedido', function ($query) use ($semana) {
                    $query->where('created_at', '>=', $semana);
                });
            }])
            ->withCount(['detalles as ventas_mes' => function ($query) use ($mes) {
                $query->whereHas('pedido', function ($query) use ($mes) {
                    $query->where('created_at', '>=', $mes);
                });
            }])
            ->get();
    }

    public function render()
    {
        return view('livewire.inventory-dashboard');
    }
}