<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    //test para comprobar que la información actual del perfil del usuario este disponible
    public function test_current_profile_information_is_available(): void
    {
        //autentica el usurio
        $this->actingAs($user = User::factory()->create());

        //comprueba que la información actual del usuario esté disponible en el componente Livewire de actualización de información de perfil
        $component = Livewire::test(UpdateProfileInformationForm::class);

        //comprueba que la información actual del usuario esté disponible en el componente Livewire
        $this->assertEquals($user->name, $component->state['name']);
        $this->assertEquals($user->email, $component->state['email']);
    }

    //test para comprobar que la información del usuario pueda ser actualizada
    public function test_profile_information_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->create());

        //actualiza la información del usuario en el componente Livewire de actualización de información de perfil
        Livewire::test(UpdateProfileInformationForm::class)
            ->set('state', ['name' => 'Test Name', 'email' => 'test@example.com'])
            ->call('updateProfileInformation');

            //comprueba que la información del usuario se haya actualizado correctamente
        $this->assertEquals('Test Name', $user->fresh()->name);
        $this->assertEquals('test@example.com', $user->fresh()->email);
    }
}
