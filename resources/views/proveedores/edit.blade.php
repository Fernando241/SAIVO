<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Naturaleza Sagrada') }}
        </h2>
    </x-slot>
    @livewire('dynamic-content')
    <br>
    <div class="container w-[80%]">
        <h1>Editar Proveedor</h1>
        <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST" enctype="multipart/form-data" id="solicitudForm">
            @csrf
            @method('PUT')
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="mt-1 w-full rounded-md border-gray-300" value="{{ $proveedor->nombre }}">
            </div>
            <div>
                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" class="mt-1 w-full rounded-md border-gray-300" value="{{ $proveedor->telefono }}">
            </div>
            <div>
                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección:</label>
                <input type="text" id="direccion" name="direccion" class="mt-1 w-full rounded-md border-gray-300" value="{{ $proveedor->direccion }}">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo:</label>
                <input type="email" id="email" name="email" class="mt-1 w-full rounded-md border-gray-300" value="{{ $proveedor->email }}">
            </div><br>
            <div class="text-center">
                <button type="button" onclick="openEditModal()" class="bg-greenG py-2 px-8 rounded-md hover:bg-greenB text-white">Editar Datos del Proveedor</button>
            </div>
        </form>

        {{-- Modal de confirmación --}}
        <div id="editConfirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm text-center">
                <h2 class="text-xl font-bold text-green-900 mb-4">¿Seguro que quieres actualizar los datos de este proveedor?</h2>
                <p class="text-gray-700 mb-4">Revisa bien los cambios antes de continuar.</p>
                <div class="flex justify-center gap-4">
                    <button id="cancelEditBtn" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</button>
                    <button id="confirmEditBtn" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-600">Actualizar</button>
                </div>
            </div>
        </div>

        <script>
            function openEditModal() {
                document.getElementById('editConfirmModal').classList.remove('hidden');
            }
            document.getElementById('cancelEditBtn').addEventListener('click', function() {
                document.getElementById('editConfirmModal').classList.add('hidden');
            });
            document.getElementById('confirmEditBtn').addEventListener('click', function() {
                document.getElementById('solicitudForm').submit();
            });
        </script>
    </div>
</x-app-layout>