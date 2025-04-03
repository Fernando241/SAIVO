<?php

namespace App\Livewire;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\DetallePedido;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $ventas;
    public $pedidos;
    public $clientes;
    public $productos;

    public function mount()
    {
        // Ventas
        $hoy = Carbon::today();
        $semana = Carbon::now()->startOfWeek();
        $mes = Carbon::now()->startOfMonth();

        $this->ventas = [
            'diarias' => Pedido::whereDate('created_at', $hoy)->sum('total'),
            'semanales' => Pedido::where('created_at', '>=', $semana)->sum('total'),
            'mensuales' => Pedido::where('created_at', '>=', $mes)->sum('total'),
        ];

        // Pedidos
        $this->pedidos = [
            'pendientes' => Pedido::where('estado', 'Pendiente')->count(),
            'enviados' => Pedido::where('estado', 'Enviado')->count(),
            'entregados' => Pedido::where('estado', 'Entregado')->count(),
        ];

        // Clientes Nuevos
        $this->clientes = Cliente::where('created_at', '>=', $mes)->count();

        // Productos más vendidos
        $this->productos = DetallePedido::select('producto_id', DB::raw('SUM(cantidad) as total_ventas'))
            ->groupBy('producto_id')
            ->orderByDesc('total_ventas')
            ->limit(5) // Obtener los 5 productos más vendidos
            ->get()
            ->map(function ($item) {
                $producto = Producto::find($item->producto_id);
                return ['nombre' => $producto->nombre, 'ventas' => $item->total_ventas];
            })
            ->toArray();
    }

    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}