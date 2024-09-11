<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\CreateTeamForm;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTeamTest extends TestCase
{
    //refresca la base de datos antes de cada prueba
    use RefreshDatabase;

    //prueba para verificar que se crean equipos
    public function test_teams_can_be_created(): void
    {
        //autentica un usuario de prueba con un equipo personal
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        //Verifica que el usuario tenga inicialmente un equipo personal
        $this->assertCount(1, $user->ownedTeams);

        //comprobamos que se crea un equipo con el nombre "Test Team" y que este pertenece al usuario logueado
        Livewire::test(CreateTeamForm::class)
            ->set(['state' => ['name' => 'Test Team']])
            ->call('createTeam');

            //comprobamos que se ha creado un equipo con el nombre "Test Team"
        $this->assertCount(2, $user->fresh()->ownedTeams);
        $this->assertEquals('Test Team', $user->fresh()->ownedTeams()->latest('id')->first()->name);
    }
}
