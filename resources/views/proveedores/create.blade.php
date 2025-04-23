<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Naturaleza Sagrada') }}
        </h2>
    </x-slot>
    @livewire('dynamic-content')
    <br>
    <div class="container w-[80%]">
        <h1>Agregar nuevo Proveedor</h1>
        <form action="{{ route('proveedores.store') }}" method="POST" enctype="multipart/form-data" id="solicitudForm">
            @csrf
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección:</label>
                <input type="text" id="direccion" name="direccion" class="mt-1 w-full rounded-md border-gray-300">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo:</label>
                <input type="email" id="email" name="email" class="mt-1 w-full rounded-md border-gray-300">
            </div><br>
            <div class="text-center">
                <button type="submit" class="p-2 bg-green-700 text-white rounded-md hover:bg-green-600 text-center">Agregar Proveedor</button>
            </div>
        </form>

    </div>
</x-app-layout>