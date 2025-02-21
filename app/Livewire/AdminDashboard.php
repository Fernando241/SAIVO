<?php

namespace App\Livewire;

use Livewire\Component;

class AdminDashboard extends Component
{
    public $ventas;  
    public $pedidos;
    public $clientes;
    public $productos;

    public function mount()
    {
        // Datos simulados (para luego los reemplazarlos con datos reales)
        $this->ventas = [
            'diarias' => rand(5, 30),
            'semanales' => rand(50, 200),
            'mensuales' => rand(200, 1000),
        ];

        $this->pedidos = [
            'pendientes' => rand(3, 20),
            'enviados' => rand(10, 30),
            'entregados' => rand(30, 100),
        ];

        $this->clientes = rand(10, 50);

        $this->productos = [
            ['nombre' => 'Producto A', 'ventas' => rand(50, 200)],
            ['nombre' => 'Producto B', 'ventas' => rand(30, 150)],
            ['nombre' => 'Producto C', 'ventas' => rand(20, 100)],
        ];
    }
    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}
