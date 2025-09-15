<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Naturaleza Sagrada') }}
        </h2>
    </x-slot>
    @livewire('dynamic-content')
    <div class="content">
        <br>
        <div>
            <button onclick="goBack()" class="text-white bg-greenG hover:gb-greenB p-2 rounded-xl fixed right-6">Volver</button>
        </div>
        <div class="container w-[60%] bg-white rounded-xl p-6">
            <h1>Mis Datos</h1><br>
            <p class="text-center text-sm text-gray-500">Mantenga Actualizados los siguientes datos, estos son necesarios para enviar su pedido con éxito</p><br>

            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" id="solicitudForm">
                @csrf
                @method('PUT')
                <div>
                    <label for="nombre" class="block text-sm font-medium">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                        value="{{ $cliente->nombre }}" required>
                </div>

                <div>
                    <label for="telefono" class="block text-sm font-medium">Teléfono:</label>
                    <input type="text" name="telefono" id="telefono" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                        value="{{ $cliente->telefono }}" required>
                </div>

                <div>
                    <label for="direccion" class="block text-sm font-medium">Dirección:</label>
                    <input type="text" name="direccion" id="direccion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                        value="{{ $cliente->direccion }}" required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium">Correo Electrónico:</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                        value="{{ $cliente->email }}" 
                        required>
                </div><br>

                {{-- <button type="submit" class="bg-greenG p-2 rounded-lg w-full hover:bg-greenB text-white">
                    {{ $cliente ? 'Confirmar Datos' : 'Continuar' }}
                </button> --}}
                <button type="button" onclick="openEditModal()" class="text-white bg-greenG hover:bg-greenB p-2 rounded-xl w-full">Actualizar Datos</button>
            </form>
        </div>
    </div>

    {{-- Modal de confirmación --}}
    <div id="editConfirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm text-center">
            <h2 class="text-xl font-bold text-green-900 mb-4">¿Seguro que quieres actualizar tus datos?</h2>
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

    <script>
        function goBack()
        {
            window.history.back();
        }
    </script>
</x-app-layout>

