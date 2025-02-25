<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidoSeeder extends Seeder
{
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
            // Crear el pedido
            $pedidoId = DB::table('pedidos')->insertGetId([
                'cliente_id' => $clientes[array_rand($clientes)],
                'total' => 0, // El total se calculará después
                'estado' => ['Pendiente', 'Enviado', 'Entregado'][array_rand(['Pendiente', 'Enviado', 'Entregado'])],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Crear detalles del pedido
            $totalPedido = 0;
            $numeroDeProductos = rand(1, 3); // Cada pedido tendrá de 1 a 3 productos
            for ($i = 0; $i < $numeroDeProductos; $i++) {
                $producto = DB::table('productos')->find($productos[array_rand($productos)]);
                $cantidad = rand(1, 5);
                $precio = $producto->precio; // Suponiendo que tienes un precio en la tabla productos
                $subtotal = $cantidad * $precio;
                $totalPedido += $subtotal;

                DB::table('detalles_pedido')->insert([
                    'pedido_id' => $pedidoId,
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio' => $precio,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Actualizar el total del pedido
            DB::table('pedidos')->where('id', $pedidoId)->update(['total' => $totalPedido]);
        }
    }
}
