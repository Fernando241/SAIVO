<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    //test para verificar que la pantalla de registro se puede renderizar
    public function test_registration_screen_can_be_rendered(): void
    {
        //si la funcionalidad de registro esta deshabilitada omite esta prueba
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        $response = $this->get('/register');

        //verifica que la respuesta tenga un 200 (OK)
        $response->assertStatus(200);
    }

    //test para verificar que la pantalla de registro no se puede renderizar si la funcionalidad de registro esta deshabilitada
    public function test_registration_screen_cannot_be_rendered_if_support_is_disabled(): void
    {
        if (Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is enabled.');
        }

        $response = $this->get('/register');

        //verifica que la respuesta tenga un 404 (Not Found)
        $response->assertStatus(404);
    }

    //test para verificar que un nuevo usuario puede registrarse con éxito
    public function test_new_users_can_register(): void
    {
        //si la funcionalidad de registro esta deshabilitada omite esta prueba
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        //realiza una solicitud POST a la ruta de registro con los datos del usuario
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
        ]);

        //verifica que la respuesta redirija al dashboard y tenga un 302 (Found)
        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
