<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Naturaleza Sagrada') }}
        </h2>
    </x-slot>
    @livewire('dynamic-content')
    <div>
        <div class="container w-[80%]">
            <br>
            <button onclick="goBack()" class="bg-greenG p-2 rounded-xl hover:bg-greenB text-white">Volver</button>
            <h1>Editar datos del gasto</h1>

            <form action="{{ route('gastos.update', $gastos->id) }}" method="POST" enctype="multipart/form-data" id="solicitudForm">
                @csrf
                @method('PUT') 
                
                {{-- Campo: Valor --}}
                <div class="mb-4">
                    <label for="valor" class="text-sm font-medium text-gray-700">Valor:</label>
                    <input type="number" id="valor" name="valor" value="{{ old('valor', $gastos->valor) }}" class="mt-1 w-full rounded-md border-gray-300 text-sm text-gray-700" required>
                </div>

                {{-- Campo: Descripción --}}
                <div class="mb-4">
                    <label for="descripcion" class="text-sm font-medium text-gray-700">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion" value="{{ old('descripcion', $gastos->descripcion) }}" class="mt-1 w-full rounded-md border-gray-300 text-sm text-gray-700" required>
                </div>

                {{-- Campo: Proveedor --}}
                <div class="mb-6">
                    <label for="proveedor_id" class="text-sm font-medium text-gray-700">Proveedor:</label>
                    <select name="proveedor_id" id="proveedor_id" class="mt-1 w-full rounded-md border-gray-300 text-sm text-gray-700" required>
                        <option value="">-- Elegir proveedor --</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}" {{ $proveedor->id == $gastos->proveedor_id ? 'selected' : '' }}>
                                {{ $proveedor->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Botones --}}
                <div class="flex justify-between">
                    {{-- <a href="{{ route('gastos.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancelar</a> --}}
                    {{-- <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Actualizar</button> --}}
                    <button type="button" onclick="openEditModal()" class="bg-greenG py-2 px-8 rounded-md hover:bg-greenB text-white">Editar Gasto</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal de confirmación --}}
    <div id="editConfirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm text-center">
            <h2 class="text-xl font-bold text-green-900 mb-4">¿Seguro que quieres actualizar este gasto?</h2>
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
        function goBack(){
            window.history.back();
        }
    </script>
</x-app-layout>