<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Http\Livewire\ApiTokenManager;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteApiTokenTest extends TestCase
{
    //reinicia la base de datos antes de cada prueba
    use RefreshDatabase;

    public function test_api_tokens_can_be_deleted(): void
    {
        // Verifica si las características de API están habilitadas
        if (! Features::hasApiFeatures()) {
            $this->markTestSkipped('API support is not enabled.');
        }

        // Crea un usuario con un equipo y un token de API
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $this->actingAs($user);


        // Agrega un token de API al usuario
        $token = $user->tokens()->create([
            'name' => 'Test Token',
            'token' => Str::random(40),
            'abilities' => ['create', 'read'],
        ]);

        // Ejecuta la vista de tokens de API y elimina el token seleccionado
        Livewire::test(ApiTokenManager::class)
            ->set(['apiTokenIdBeingDeleted' => $token->id])
            ->call('deleteApiToken');

            // Verifica que el token de API se ha eliminado correctamente
        $this->assertCount(0, $user->fresh()->tokens);
    }
}
