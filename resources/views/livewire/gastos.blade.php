<div>
    <h1>Gastos</h1><br>

    <div class="container w-[80%]">
        <div class="text-center">
            <input 
            wire:model="search"
            wire:keyup="buscarGastos"
            class="w-[70%] rounded-md"
            placeholder="Ingrese el nombre o descripción del gasto">
        </div><br>

        @if (count($gastos))
            <table class="table">
                <thead>
                    <tr class="bg-greenB text-white">
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Valor</th>
                        <th>Descripción</th>
                        <th>Proveedor</th>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gastos as $item)
                        <tr class="p-4 hover:border border-slate-500">
                            <td class="text-center p-2">{{ $item->id }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y') }}</td>
                            <td class="text-center">$ {{ number_format($item->valor, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $item->descripcion }}</td>
                            <td class="text-center">{{ $item->proveedor->nombre }}</td>
                            <td class="text-center">
                                <a href="{{ route('gastos.edit', $item->id) }}" class="bg-greenG p-2 rounded-md text-white hover:bg-greenB">Editar</a>
                                <form id="form-delete-{{ $item->id }}" action="{{ route('gastos.destroy', $item->id)}}" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" 
                                    onclick="confirmDelete({{ $item->id }})" 
                                    class="text-white bg-red-500 p-2 hover:bg-red-400 rounded-md">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        @else
            
            <h2><b>No hay registros</b></h2>
        @endif
        <div>
            <br>
            <p class="text-center text-gray-600 font-light">Nota:<br>Para agregar un nuevo gasto, primero debe agregar el proveedor en la pestaña "Proveedores"</p>
            <br>
            <div class="flex justify-center">
                <a href="{{ route('gastos.create') }}" class="inline-block px-8 py-3 text-sm font-medium text-white bg-greenG hover:bg-greenB rounded-md">Agregar nuevo gasto</a>
            </div>
        </div>
    </div>
    
    <!-- Modal de confirmación (oculto por defecto) -->
    <div id="confirmation-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">
            <h2 class="text-xl font-bold text-red-700">¿Realmente quieres eliminar este gasto?</h2>
            <p class="text-gray-700 mt-2">¡Esta acción no puede deshacerse!</p>
            <div class="flex justify-between mt-4">
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700 transition">Cancelar</button>
                <button id="confirm-delete" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-800 transition">Eliminar</button>
            </div>
        </div>
    </div>
</div>

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
