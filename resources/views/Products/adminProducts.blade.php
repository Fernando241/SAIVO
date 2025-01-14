<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Naturaleza Sagrada') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- icono de flecha atras para volver a la dashboard --}}
            <div class="flex justify-end">
                <a href="{{ route('dashboard') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Volver
                </a>
            </div><br>
            <div class="container">
                <table class="">
                    <thead class="bg-green-400">
                        <tr>
                            <th>imagen</th>
                            <th>Nombre</th>
                            <th>Presentación</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="p-4 hover:border border-slate-500">
                                <td><img src="{{ asset('images/'. $product->imagen) }}" alt="{{ $product->nombre }}" class="h-32 object-cover rounded-lg m-auto"></td>
                                <td>{{ $product->nombre }}</td>
                                <td class="text-center">{{ $product->presentacion }}</td>
                                <td class="text-center">{{ $product->stock }}</td>
                                <td class="text-center">
                                    <a href="{{ route('productos.edit', $product->id) }}" class="text-green-600 hover:text-green-800">Editar</a>
                                    <form action="{{ route('productos.destroy', $product->id) }}" method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Borrar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><br>
            {{-- Agregar nuevo producto --}}
            <div class="flex justify-center">
                <a href="{{ route('productos.create') }}" class="inline-block px-8 py-3 text-sm font-medium text-white bg-green-600 hover:bg-green-800 rounded-md">Agregar Nuevo Producto</a>
    
        </div>
    </div>
</x-app-layout>