<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'fhernatural@gmail.com')->first();

        if($admin) {
            Cliente::firstOrCreate(
                    ['user_id' => $admin->id], //condición de busqueda
                    [ //valores para crear en caso que no exista
                        'nombre' => $admin->name,
                        'email' => $admin->email,
                        'telefono' => '3204195115',
                        'direccion' => 'Carrera 9 Este # 35 - 80, Soacha - Cundinamarca',
                    ]
                );
            
        }

        if (Cliente::count() < 101) {
            Cliente::factory()->count(100)->create();
        }

        /* Cliente::factory()->count(100)->create(); */
    }
}
