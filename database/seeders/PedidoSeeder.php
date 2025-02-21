<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener IDs de clientes y productos existentes
        $clientes = DB::table('clientes')->pluck('id')->toArray();
        $productos = DB::table('productos')->pluck('id')->toArray();

        // Verificar que existan datos antes de insertar
        if (empty($clientes) || empty($productos)) {
            return;
        }

        // Insertar pedidos de prueba
        foreach (range(1, 10) as $index) {
            DB::table('pedidos')->insert([
                'cliente_id' => $clientes[array_rand($clientes)],  // Selecciona un cliente aleatorio
                'producto_id' => $productos[array_rand($productos)], // Selecciona un producto aleatorio
                'total' => rand(100, 1000) / 10, // Número aleatorio entre 10.0 y 100.0
                'estado' => ['Pendiente', 'Enviado', 'Entregado'][array_rand(['Pendiente', 'Enviado', 'Entregado'])], // Estado aleatorio
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
