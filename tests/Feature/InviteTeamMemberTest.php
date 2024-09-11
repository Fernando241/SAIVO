<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Http\Livewire\TeamMemberManager;
use Laravel\Jetstream\Mail\TeamInvitation;
use Livewire\Livewire;
use Tests\TestCase;

class InviteTeamMemberTest extends TestCase
{
    //refresca la base de datos antes de cada prueba
    use RefreshDatabase;

    //test para invitar a un miembro a un equipo
    public function test_team_members_can_be_invited_to_team(): void
    {
        //verifica si las invitaciones de equipo estan habilitadas
        if (! Features::sendsTeamInvitations()) {
            $this->markTestSkipped('Team invitations not enabled.');
        }

        // Simula el envío de un correo electrónico para invitar al miembro
        Mail::fake();

        // Crea un usuario con un equipo personal
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        // Agrega un miembro al equipo...
        Livewire::test(TeamMemberManager::class, ['team' => $user->currentTeam])
            ->set('addTeamMemberForm', [
                'email' => 'test@example.com',
                'role' => 'admin',
            ])->call('addTeamMember');

             // Verifica que el correo electrónico sea enviado
        Mail::assertSent(TeamInvitation::class);

        // Verifica que la invitación se ha guardado en la base de datos
        $this->assertCount(1, $user->currentTeam->fresh()->teamInvitations);
    }

    // test para cancelar una invitación de equipo
    public function test_team_member_invitations_can_be_cancelled(): void
    {
        // Check if team invitations are enabled...
        if (! Features::sendsTeamInvitations()) {
            $this->markTestSkipped('Team invitations not enabled.');
        }

        // Simulate sending an email for team invitation...
        Mail::fake();

        // Create a user with a personal team...
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        // Add the team member...
        $component = Livewire::test(TeamMemberManager::class, ['team' => $user->currentTeam])
            ->set('addTeamMemberForm', [
                'email' => 'test@example.com',
                'role' => 'admin',
            ])->call('addTeamMember');

        $invitationId = $user->currentTeam->fresh()->teamInvitations->first()->id;

        // Cancel the team invitation...
        $component->call('cancelTeamInvitation', $invitationId);

        $this->assertCount(0, $user->currentTeam->fresh()->teamInvitations);
    }
}
