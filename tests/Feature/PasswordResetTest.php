<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Laravel\Fortify\Features;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    //test para verificar que la pantalle de enlace de restablecimiento de contraseña se pueda renderizar
    public function test_reset_password_link_screen_can_be_rendered(): void
    {
        if (! Features::enabled(Features::resetPasswords())) {
            $this->markTestSkipped('Password updates are not enabled.');
        }

        $response = $this->get('/forgot-password');

        //asegura que la respuesta sea 200 (OK)
        $response->assertStatus(200);
    }

    //test para verificar que se pueda solicitar un enlace de restablecimiento de contraseña
    public function test_reset_password_link_can_be_requested(): void
    {
        if (! Features::enabled(Features::resetPasswords())) {
            $this->markTestSkipped('Password updates are not enabled.');
        }

        //simula las notificaciones
        Notification::fake();

        //crea un usuario de prueba
        $user = User::factory()->create();

        $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        //asegura que la notificación de restablecimiento de contraseña sea enviada al usuario
        Notification::assertSentTo($user, ResetPassword::class);
    }

    //test para verificar que se pueda ver la pantalla de restablecimiento de contraseña con un token válido
    public function test_reset_password_screen_can_be_rendered(): void
    {
        if (! Features::enabled(Features::resetPasswords())) {
            $this->markTestSkipped('Password updates are not enabled.');
        }

        //simula el envio de notificaciones
        Notification::fake();

        $user = User::factory()->create();

        $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        //asegura que la notificación de restablecimiento de contraseña sea enviada al usuario y que la pantalla de restablecimiento de contraseña se pueda renderizar con el token válido
        Notification::assertSentTo($user, ResetPassword::class, function (object $notification) {
            $response = $this->get('/reset-password/'.$notification->token);

            $response->assertStatus(200);

            return true;
        });
    }

    //test para verificar que se pueda restablecer la contraseña con un token válido y una contraseña válida
    public function test_password_can_be_reset_with_valid_token(): void
    {
        if (! Features::enabled(Features::resetPasswords())) {
            $this->markTestSkipped('Password updates are not enabled.');
        }

        Notification::fake();

        $user = User::factory()->create();

        $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class, function (object $notification) use ($user) {
            $response = $this->post('/reset-password', [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            //asegura que no haya errores en la sesión
            $response->assertSessionHasNoErrors();

            return true;
        });
    }
}
