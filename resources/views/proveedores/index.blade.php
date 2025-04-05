<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Naturaleza Sagrada') }}
        </h2>
    </x-slot>
    @livewire('dynamic-content')
    <div>
        @livewire('proveedors')
    </div>
</x-app-layout>