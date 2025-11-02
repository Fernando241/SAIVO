<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario principal
        $usuario = User::firstOrCreate(
            ['email' => 'fhernatural@gmail.com'],
            [
            'name' => 'Fernando Rolón',
            'password' => bcrypt('Luis1234'),
            'email_verified_at' => Carbon::now(),
            ]
        );

        // Asignar rol
        $usuario->assignRole('SuperAdmin');

        // Crear otros usuarios con el mismo equipo
        /* User::factory(20)->create([
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('Saivo1234'),
        ]); */
    }
}
