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

            <form action="{{ route('gastos.update', $gastos->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Laravel necesita esto para aceptar PUT en formularios --}}
                
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
                    <a href="{{ route('gastos.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancelar</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function goBack(){
            window.history.back();
        }
    </script>
</x-app-layout>