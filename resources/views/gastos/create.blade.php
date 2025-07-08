<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Naturaleza Sagrada') }}
        </h2>
    </x-slot>
    @livewire('dynamic-content')
    <div class="container w-[80%]">
        <br>
        <button onclick="goBack()" class="bg-greenG p-2 rounded-xl hover:bg-greenB text-white">
            Volver
        </button>
        <h1>Agregar nuevo gasto</h1>
        <form action="{{ route('gastos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="valor" class="text-sm font-medium text-gray-700">Valor:</label>
                <input type="number" id="valor" name="valor" class="mt-1 w-full rounded-md border-gray-300" required>
            </div>
            <div>
                <label for="descripcion" class="text-sm font-medium text-gray-700">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" class="mt-1 w-full rounded-md border-gray-300" required>
            </div>
            <div>
                <label for="proveedor_id" class="text-sm font-medium text-gray-700">Proveedor:</label>
                <select name="proveedor_id" id="proveedor_id" class="mt-1 w-full rounded-md border-gray-300 text-sm text-gray-700" required>
                    <option value="">-- Elegir proveedor --</option>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-center">
                <button type="submit" class="p-2 bg-greenB text-white hover:bg-greenG rounded-xl mt-2">Agregar gasto</button>
            </div>
        </form>
    </div>


    <script>
        function goBack(){
            window.history.back();
        }
    </script>
</x-app-layout>