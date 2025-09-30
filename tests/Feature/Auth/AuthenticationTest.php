<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    //refresca la base de datos antes de cada prueba
    use RefreshDatabase;

    //prueba que la pantalla de inicio de sesión se puede renderizar
    public function test_login_screen_can_be_rendered(): void
    {
        //realiza una solicitud GET a la ruta '/login'
        $response = $this->get('/login');

        //comprueba que el código de estado de respuesta es 200 (OK)
        $response->assertStatus(200);
    }


    //prueba que los usuarios pueden iniciar sesión correctamente con credenciales válidas
    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        //crea un usuario prueba usando la fábrica
        $user = User::factory()->create();

        //realiza una solicitud POST a la ruta '/login' con las credenciales del usuario
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        //comprueba que el usuario ha iniciado sesión correctamente y que se ha redireccionado a la página de dashboard
        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    //prueba que los usuarios no pueden iniciar sesión con credenciales inválidas
    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        //realiza una solicitud POST a la ruta '/login' con las credenciales incorrectas
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        //comprueba que el usuario ha recibido un mensaje de error de inicio de sesión y que no se ha redireccionado a la página de dashboard
        $this->assertGuest();
    }
}
