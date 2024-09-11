<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Laravel\Fortify\Features;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    //refresca la base de datos antes de cada prueba
    use RefreshDatabase;

    public function test_email_verification_screen_can_be_rendered(): void
    {
        //omite la prueba si la verificación de correo no está habilitada
        if (! Features::enabled(Features::emailVerification())) {
            $this->markTestSkipped('Email verification not enabled.');
        }

        //crea un usuario no verificado con un equipo personal
        $user = User::factory()->withPersonalTeam()->unverified()->create();

        //obtiene la pantalla de verificación de correo
        $response = $this->actingAs($user)->get('/email/verify');

        //la respuesta debe estar con éxito y mostrar la pantalla de verificación de correo
        $response->assertStatus(200);
    }

    public function test_email_can_be_verified(): void
    {
        //omite la prueba si la verificación de correo no está habitada
        if (! Features::enabled(Features::emailVerification())) {
            $this->markTestSkipped('Email verification not enabled.');
        }

        //falsifica lo eventos para la prueba
        Event::fake();

        //crea un usuario no verificado con un equipo personal
        $user = User::factory()->unverified()->create();

        //obtiene la URL de verificación de correo temporaria
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        //verifica el correo con la URL de verificación
        $response = $this->actingAs($user)->get($verificationUrl);

        //el evento de verificación de correo debe haber sido despachado
        Event::assertDispatched(Verified::class);

        //el usuario debe haber sido verificado y la pantalla de bienvenida debe estar redireccionada
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        $response->assertRedirect(route('dashboard', absolute: false).'?verified=1');
    }

    public function test_email_can_not_verified_with_invalid_hash(): void
    {
        //omit la prueba si la verificación de correo no está habilitada
        if (! Features::enabled(Features::emailVerification())) {
            $this->markTestSkipped('Email verification not enabled.');
        }

        //crea un usuario no verificado con un equipo personal
        $user = User::factory()->unverified()->create();

        //obtiene la URL de verificación de correo con un hash incorrecto
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1('wrong-email')]
        );

        //la petición a la URL de verificación de correo con un hash incorrecto debe responder con un código de estado 404
        $this->actingAs($user)->get($verificationUrl);

        //el usuario no debe haber sido verificado y la pantalla de bienvenida no debe estar redireccionada
        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }
}
