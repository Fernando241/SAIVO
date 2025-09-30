<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Siempre se crean los roles, porque son base del sistema
        $this->call(RoleSeeder::class);

        // Solo cargar datos extra si NO son pruebas
        if (!app()->runningUnitTests()) {
            $this->call([
                UserSeeder::class,
                ClienteSeeder::class,
                ProveedorSeeder::class,
                /* PedidoSeeder::class, */
            ]);
        }
    }
}
