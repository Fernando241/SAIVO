<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Http\Livewire\DeleteUserForm;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteAccountTest extends TestCase
{
    //refresca la base de datos antes de la prueba
    use RefreshDatabase;

    //prueba que las cuentas de usuario pueden ser borradas
    public function test_user_can_be_deleted_without_teams(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $this->actingAs($user);


        $user->delete(); // elimina el usuario directamente
        $this->assertNull($user->fresh());
    }


    //prueba que se muestra un error si la contraseña no coincide
    public function test_correct_password_must_be_provided_before_account_can_be_deleted(): void
    {
        //omite la prueba si la funcionalidad de cuentas no esta habilitada
        if (! Features::hasAccountDeletionFeatures()) {
            $this->markTestSkipped('Account deletion is not enabled.');
        }

        //crea un usuario y lo ingresa
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $this->actingAs($user);


        Livewire::test(DeleteUserForm::class)
            ->set('password', 'wrong-password') //establece un valor incorrecto para el campo password
            ->call('deleteUser')
            ->assertHasErrors(['password']);

            //comprueba que no se ha borrado la cuenta de usuario
        $this->assertNotNull($user->fresh());
    }
}
