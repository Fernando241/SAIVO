<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Http\Livewire\ApiTokenManager;
use Livewire\Livewire;
use Tests\TestCase;

class CreateApiTokenTest extends TestCase
{
    //refesca la base de datos antes de cada prueba
    use RefreshDatabase;

    //prueba que los tokens API pueden ser creados
    public function test_api_tokens_can_be_created(): void
    {
        // Asegurarse de que las características de API estén habilitadas
        if (! Features::hasApiFeatures()) {
            $this->markTestSkipped('API support is not enabled.');
        }

        // Crear un usuario con un equipo personal
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        // Verificar que se puede crear un token API
        Livewire::test(ApiTokenManager::class)
        
            //establece los datos del formulario de creación de token API
            ->set(['createApiTokenForm' => [
                'name' => 'Test Token',
                'permissions' => [
                    'read',
                    'update',
                ],
            ]])
            //llama al método de creación de token API
            ->call('createApiToken');

            //comprueba que el token API se ha creado correctamente
        $this->assertCount(1, $user->fresh()->tokens);
        $this->assertEquals('Test Token', $user->fresh()->tokens->first()->name);
        $this->assertTrue($user->fresh()->tokens->first()->can('read'));
        $this->assertFalse($user->fresh()->tokens->first()->can('delete'));
    }
}
