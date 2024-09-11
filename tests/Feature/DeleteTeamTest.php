<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\DeleteTeamForm;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteTeamTest extends TestCase
{
    //reinicia la base de datos antes de cada prueba
    use RefreshDatabase;

    public function test_teams_can_be_deleted(): void
    {
        //autentica un usuario creado con la fabrica y un equipo personal
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        //crea un equipo que no es personal
        $user->ownedTeams()->save($team = Team::factory()->make([
            'personal_team' => false,
        ]));

        //agrega un usuario a otro equipo para probar la eliminación de equipos
        $team->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'test-role']
        );

        Livewire::test(DeleteTeamForm::class, ['team' => $team->fresh()])
            ->call('deleteTeam');

            //verifica que el equipo fue eliminado y que el usuario se ha desasignado del equipo
        $this->assertNull($team->fresh());
        $this->assertCount(0, $otherUser->fresh()->teams);
    }

    public function test_personal_teams_cant_be_deleted(): void
    {
        //autentica un usuario creado con la fabrica y un equipo personal
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        Livewire::test(DeleteTeamForm::class, ['team' => $user->currentTeam])
            ->call('deleteTeam')
            ->assertHasErrors(['team']);

            //verifica que el equipo no fue eliminado y que el usuario sigue en su equipo personal
        $this->assertNotNull($user->currentTeam->fresh());
    }
}
