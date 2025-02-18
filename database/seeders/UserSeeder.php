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
        // Obtener el primer equipo existente o crearlo si no hay ninguno
        $team = Team::first() ?? Team::create([
            'user_id' => 1, // ID del usuario dueño del equipo (cámbialo si es necesario)
            'name' => 'Equipo Predeterminado',
            'personal_team' => true,
        ]);

        // Crear usuario principal con equipo asignado
        $usuario = User::create([
            'name' => 'Fernando Rolón',
            'email' => 'fhernatural@gmail.com',
            'password' => bcrypt('Luis1234'),
            'email_verified_at' => Carbon::now(),
            'current_team_id' => $team->id,
        ]);

        // Asignar rol
        $usuario->assignRole('SuperAdmin');

        // Asignar el usuario al equipo
        $team->users()->attach($usuario->id, ['role' => 'Admin']);

        // Iniciar sesión automáticamente con este usuario (opcional)
        /* Auth::loginUsingId($usuario->id); */

        // Crear otros usuarios con el mismo equipo
        User::factory(20)->create([
            'email_verified_at' => Carbon::now(),
            'current_team_id' => $team->id,
            'password' => bcrypt('Saivo1234'),
        ])->each(function ($user) use ($team) {
            $team->users()->attach($user->id, ['role' => 'member']);
        });
    }
}
