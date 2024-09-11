<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\LogoutOtherBrowserSessionsForm;
use Livewire\Livewire;
use Tests\TestCase;

class BrowserSessionsTest extends TestCase
{
    //Usa el trait RefreshDatabase para reiniciar la base de datos antes de cada prueba
    use RefreshDatabase;

    //Prueba que otras sesiones de navegador pueden ser cerradas correctamente
    public function test_other_browser_sessions_can_be_logged_out(): void
    {
        //Crea un usuario y crea una sesión en el navegador del usuario
        $this->actingAs(User::factory()->create());

        //Abre una nueva pestaña y inicia sesión en un navegador diferente
        Livewire::test(LogoutOtherBrowserSessionsForm::class)
            ->set('password', 'password')
            ->call('logoutOtherBrowserSessions')
            ->assertSuccessful();
    }
}
