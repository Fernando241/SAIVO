<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\TeamMemberManager;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateTeamMemberRoleTest extends TestCase
{
    use RefreshDatabase;

    // Test para verificar que los roles de los miembros del equipo pueden ser actualizados
    public function test_team_member_roles_can_be_updated(): void
    {
        // Actuar como un usuario con un equipo personal
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        // Adjuntar otro usuario al equipo del usuario actual con el rol de 'admin'
        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'admin']
        );

        // Simular la actualización del rol del miembro del equipo
        Livewire::test(TeamMemberManager::class, ['team' => $user->currentTeam])
            ->set('managingRoleFor', $otherUser)
            ->set('currentRole', 'editor')
            ->call('updateRole');

            // Asegúrate de que el rol del miembro del equipo se haya actualizado correctamente
        $this->assertTrue($otherUser->fresh()->hasTeamRole(
            $user->currentTeam->fresh(), 'editor'
        ));
    }

    // Test para verificar que solo el propietario del equipo puede actualizar los roles de los miembros del equipo
    public function test_only_team_owner_can_update_team_member_roles(): void
    {
        // Actuar como un usuario con un equipo personal
        $user = User::factory()->withPersonalTeam()->create();

        // Adjuntar otro usuario al equipo del usuario actual con el rol de 'admin'
        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'admin']
        );

        // Simular la actualización del rol del miembro del equipo
        $this->actingAs($otherUser);

        // Asegúrate de que el rol del miembro del equipo no se haya actualizado correctamente,
        // debido a que el usuario actual no es el propietario del equipo
        Livewire::test(TeamMemberManager::class, ['team' => $user->currentTeam])
            ->set('managingRoleFor', $otherUser)
            ->set('currentRole', 'editor')
            ->call('updateRole')
            ->assertStatus(403);

            // Asegúrate de que el rol del miembro del equipo sigue con el rol 'admin' original
        $this->assertTrue($otherUser->fresh()->hasTeamRole(
            $user->currentTeam->fresh(), 'admin'
        ));
    }
}
