<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Http\Livewire\TwoFactorAuthenticationForm;
use Livewire\Livewire;
use Tests\TestCase;

class TwoFactorAuthenticationSettingsTest extends TestCase
{
    use RefreshDatabase;

    //test para verificar que la autenticación de dos factores se puede habilitar
    public function test_two_factor_authentication_can_be_enabled(): void
    {
        //si la actualización de dos factores no esta habilidatada se omite esta prueba
        if (! Features::canManageTwoFactorAuthentication()) {
            $this->markTestSkipped('Two factor authentication is not enabled.');
        }

        //autentica el usuario
        $this->actingAs($user = User::factory()->create());

        //simula la confirmación de contraseña del usuario
        $this->withSession(['auth.password_confirmed_at' => time()]);

        //Prueba la habilitación de la autenticación de dos factores usando livewire
        Livewire::test(TwoFactorAuthenticationForm::class)
            ->call('enableTwoFactorAuthentication');

            //refresca el usuario para obtener los datos más recientes
        $user = $user->fresh();

        //verifica que el código de secreto de dos factores no sea nulo
        $this->assertNotNull($user->two_factor_secret);
        $this->assertCount(8, $user->recoveryCodes());
    }

    //test para verificar que los códigos de recuperación se pueden generar y actualizar
    public function test_recovery_codes_can_be_regenerated(): void
    {
        //si la actualización de dos factores no esta habilitada se omite esta prueba
        if (! Features::canManageTwoFactorAuthentication()) {
            $this->markTestSkipped('Two factor authentication is not enabled.');
        }

        //autentica el usuario
        $this->actingAs($user = User::factory()->create());

        //simula la confirmación de contraseña del usuario
        $this->withSession(['auth.password_confirmed_at' => time()]);

        //Prueba la habilitación de la autenticación de dos factores usando livewire
        $component = Livewire::test(TwoFactorAuthenticationForm::class)
            ->call('enableTwoFactorAuthentication')
            ->call('regenerateRecoveryCodes');

            //refresca el usuario para obtener los datos más recientes
        $user = $user->fresh();

        //verifica que los códigos de recuperación se han generado y actualizado
        $component->call('regenerateRecoveryCodes');

        //verifica que los códigos de recuperación se han generado y actualizado
        $this->assertCount(8, $user->recoveryCodes());
        $this->assertCount(8, array_diff($user->recoveryCodes(), $user->fresh()->recoveryCodes()));
    }

    //test para verificar que la autenticación de dos factores se puede deshabilitar
    public function test_two_factor_authentication_can_be_disabled(): void
    {
        //si la actualización de dos factores no esta habilitada se omite esta prueba
        if (! Features::canManageTwoFactorAuthentication()) {
            $this->markTestSkipped('Two factor authentication is not enabled.');
        }

        //autentica el usuario
        $this->actingAs($user = User::factory()->create());

        //simula la confirmación de contraseña del usuario
        $this->withSession(['auth.password_confirmed_at' => time()]);

        //Prueba la habilitación de la autenticación de dos factores usando livewire
        $component = Livewire::test(TwoFactorAuthenticationForm::class)
            ->call('enableTwoFactorAuthentication');

            //refresca el usuario para obtener los datos más recientes
        $this->assertNotNull($user->fresh()->two_factor_secret);

        //prueba la deshabilitación de la autenticación de dos factores usando livewire
        $component->call('disableTwoFactorAuthentication');

        //refresca el usuario para obtener los datos más recientes
        $this->assertNull($user->fresh()->two_factor_secret);
    }
}
