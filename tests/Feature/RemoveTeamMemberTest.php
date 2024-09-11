<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\TeamMemberManager;
use Livewire\Livewire;
use Tests\TestCase;

class RemoveTeamMemberTest extends TestCase
{
    use RefreshDatabase;

    //test para verificar que los mienbros de un equipo puedes ser eliminados
    public function test_team_members_can_be_removed_from_teams(): void
    {
        //autentica el usuario y crea un equipo personal para el
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        //agrega otro miembro de equipo al equipo personal del usuario
        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'admin']
        );

        //llama al componente TeamMemberManager y lo testea para verificar que el miembro de equipo puede ser eliminado
        Livewire::test(TeamMemberManager::class, ['team' => $user->currentTeam])
            ->set('teamMemberIdBeingRemoved', $otherUser->id)
            ->call('removeTeamMember');

            //verifica que solo el propiedtario del equipo puede eliminar miembros del equipo
        $this->assertCount(0, $user->currentTeam->fresh()->users);
    }

    //test para verificar que el usuario que no es el dueño del equipo no puede eliminar miembros del equipo
    public function test_only_team_owner_can_remove_team_members(): void
    {
        $user = User::factory()->withPersonalTeam()->create();

        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'admin']
        );

        $this->actingAs($otherUser);

        // Intenta eliminar al propietario del equipo usando Livewire y verifica que se deniegue la acción
        Livewire::test(TeamMemberManager::class, ['team' => $user->currentTeam])
            ->set('teamMemberIdBeingRemoved', $user->id)
            ->call('removeTeamMember')
            ->assertStatus(403);
    }
}
