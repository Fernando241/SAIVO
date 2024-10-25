<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Naturaleza Sagrada') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <nav id="menu">
                <a href="{{ url('/') }}" class="nav_menu {{ request()->is('/') ? 'active' : '' }}">Inicio</a>
                <a href="{{ url('/nosotros') }}" class="nav_menu {{ request()->is('nosotros') ? 'active' : '' }}">Inventario</a>
                <a href="{{ url('/productos') }}" class="nav_menu {{ request()->is('productos') ? 'active' : '' }}">Productos</a>
                <a href="{{ url('/recetas') }}" class="nav_menu {{ request()->is('recetas') ? 'active' : '' }}">Contabilidad</a>
            </nav><br>

            <div class="container">
                @livewire('show-products', ['title' => 'Este es un título de prueba'])
            </div>
            
            
        </div>
    </div>
</x-app-layout>
