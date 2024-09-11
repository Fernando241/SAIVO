<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateTeamNameForm;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateTeamNameTest extends TestCase
{
    use RefreshDatabase;

    // Test para verificar que los nombres de los equipos pueden ser actualizados
    public function test_team_names_can_be_updated(): void
    {
        // Actuar como un usuario con un equipo personal
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        // Simular el evento de actualización del nombre del equipo
        Livewire::test(UpdateTeamNameForm::class, ['team' => $user->currentTeam])
            ->set(['state' => ['name' => 'Test Team']])
            ->call('updateTeamName');

        // Asegurarse de que el usuario sigue teniendo un equipo propio
        $this->assertCount(1, $user->fresh()->ownedTeams);
        // Asegurarse de que el nombre del equipo ha sido actualizado correctamente
        $this->assertEquals('Test Team', $user->currentTeam->fresh()->name);
    }
}
