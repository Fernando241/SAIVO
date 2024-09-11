<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    //test para verificar que la pantalla de confirmación de contraseñas se puede renderizar
    public function test_confirm_password_screen_can_be_rendered(): void
    {
        //crea un usuario en un equipo personal
        $user = User::factory()->withPersonalTeam()->create();

        //realiza una petición GET para la pantalla de confirmación de contraseñas del usuario
        $response = $this->actingAs($user)->get('/user/confirm-password');

        //verifica que la respuesta es 200 (OK) y que la vista se renderiza correctamente
        $response->assertStatus(200);
    }

    //test para verificar que el usuario puede confirmar la contraseña
    public function test_password_can_be_confirmed(): void
    {
        //crea un usuario
        $user = User::factory()->create();

        //realiza una petición POST para confirmar la contraseña del usuario
        $response = $this->actingAs($user)->post('/user/confirm-password', [
            'password' => 'password',
        ]);

        //verifica que la respuesta es redireccionada correctamente y que no hay errores en el inicio de sesión
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    //test para verificar que el usuario no puede confirmar la contraseña si la contraseña es inválida
    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        $user = User::factory()->create();

        //realiza una petición POST para confirmar la contraseña del usuario con una contraseña incorrecta
        $response = $this->actingAs($user)->post('/user/confirm-password', [
            'password' => 'wrong-password',
        ]);

        //verifica que la respuesta es redireccionada correctamente y que hay errores en el inicio de sesión
        $response->assertSessionHasErrors();
    }
}
