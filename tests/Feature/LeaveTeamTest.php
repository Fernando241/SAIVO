<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\TeamMemberManager;
use Livewire\Livewire;
use Tests\TestCase;

class LeaveTeamTest extends TestCase
{
    //refresca la base de datos antes de cada prueba
    use RefreshDatabase;

    //test para verificar que los usuarios pueden dejar equipos
    public function test_users_can_leave_teams(): void
    {
        //crea un usuario con un equipo personal
        $user = User::factory()->withPersonalTeam()->create();

        //crea un usuario administrador en el equipo
        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'admin']
        );

        //loguea al usuario administrador del equipo para verificar que puede dejarlo
        $this->actingAs($otherUser);

        //llama al componente TeamMemberManager para verificar que el administrador puede dejar el equipo
        Livewire::test(TeamMemberManager::class, ['team' => $user->currentTeam])
            ->call('leaveTeam');

            //verifica que el administrador ha sido desvinculado del equipo
        $this->assertCount(0, $user->currentTeam->fresh()->users);
    }

    //test para verificar que los propietarios del equipo no pueden dejar su propio equipo
    public function test_team_owners_cant_leave_their_own_team(): void
    {
        //crea un usuario con un equipo personal y un propietario
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        //llama al componente TeamMemberManager para verificar que el propietario no puede dejar su equipo
        Livewire::test(TeamMemberManager::class, ['team' => $user->currentTeam])
            ->call('leaveTeam')
            ->assertHasErrors(['team']);

            //verifica que el equipo del propietario aún exista después del intento fallido de dejar el equipo
        $this->assertNotNull($user->currentTeam->fresh());
    }
}
