<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Http\Livewire\UpdatePasswordForm;
use Livewire\Livewire;
use Tests\TestCase;

class UpdatePasswordTest extends TestCase
{
    use RefreshDatabase;

    //test para verificar que la contraseña de usuario se puede actualizar
    public function test_password_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->create());

        //prueba de actualización de contraseña del usuario usando livewire
        Livewire::test(UpdatePasswordForm::class)
            ->set('state', [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ])
            ->call('updatePassword');

            //verifica que la nueva contraseña se halla guardado correctamente
        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
    }

    //test para verificar que la contraseña actual del usuario es correcta para actualizar la contraseña
    public function test_current_password_must_be_correct(): void
    {
        $this->actingAs($user = User::factory()->create());

        //prueba de actualización de contraseña del usuario usando livewire
        Livewire::test(UpdatePasswordForm::class)
            ->set('state', [
                'current_password' => 'wrong-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ])
            ->call('updatePassword')
            ->assertHasErrors(['current_password']);

            //verifica que la contraseña actual no se haya modificado
        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }

    //test para verificar que las nuevas contraseñas sean iguales para actualizar la contraseña
    public function test_new_passwords_must_match(): void
    {
        $this->actingAs($user = User::factory()->create());

        //prueba de actualización de contraseña del usuario usando livewire
        Livewire::test(UpdatePasswordForm::class)
            ->set('state', [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'wrong-password',
            ])
            ->call('updatePassword')
            ->assertHasErrors(['password']);

            //verifica que la contraseña actual no se haya modificado
        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }
}
