<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Naturaleza Sagrada') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="container">
        {{-- alertas en páginas que heredan de esta plantilla --}}
        @if(session('success')) 
            <div x-data="{ show: true }" 
                x-show="show" 
                x-init="setTimeout(() => show = false, 2000)" 
                class="fixed top-32 md:top-20 right-5 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg">
                <strong class="font-bold">¡Éxito!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1>Administración de Productos e Inventario</h1>
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
                                    <form id="form-delete-{{ $product->id }}" 
                                        action="{{ route('productos.destroy', $product->id) }}" 
                                        method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete('{{ $product->id }}')" 
                                                class="block text-center text-red-900 hover:text-red-700 font-bold py-2 transition duration-300">
                                            Borrar
                                        </button>
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
    </div>

    <!-- Modal de confirmación (oculto por defecto) -->
    <div id="confirmation-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">
            <h2 class="text-xl font-bold text-red-700">¿Realmente quieres eliminar este producto?</h2>
            <p class="text-gray-700 mt-2">¡Esta acción no puede deshacerse!</p>
            <div class="flex justify-between mt-4">
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700 transition">Cancelar</button>
                <button id="confirm-delete" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-800 transition">Eliminar</button>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Importa el script para el manejo del modal -->
<script>
    function confirmDelete(productId) {
        // Mostrar el modal
        document.getElementById('confirmation-modal').classList.remove('hidden');
        // Asignar el id del formulario al botón de confirmación
        document.getElementById('confirm-delete').onclick = function () {
            document.getElementById('form-delete-' + productId).submit();
        };
    }

    function closeModal() {
        // Ocultar el modal
        document.getElementById('confirmation-modal').classList.add('hidden');
    }
</script>

