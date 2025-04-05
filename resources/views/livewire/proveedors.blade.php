<div>
    <br>
    <h1>Proveedores</h1>

    <div class="container">
        <div class="text-center">
            <input 
            wire:model="search"
            wire:keyup="buscarProveedores"
            class="w-[70%] rounded-md"
            placeholder="Ingrese el nombre o correo del proveedor">
        </div><br>

        @if (count($proveedor))

            <table>
                <thead>
                    <tr class="bg-greenG text-white p-2">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th class="hidden xl:table-cell">Dirección</th>
                        <th>Teléfono</th>
                        <th class="hidden md:table-cell">Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedor as $item)
                        <tr class="hover:border border-slate-500">
                            <td class="text-center">{{ $item->id }}</td>
                            <td class="text-center">{{ $item->nombre }}</td>
                            <td class="text-center hidden xl:table-cell">{{ $item->direccion }}</td>
                            <td class="text-center">{{ $item->telefono }}</td>
                            <td class="text-center hidden md:table-cell">{{ $item->email }}</td>
                            <td class="text-center p-1">
                                <a href="{{ route('proveedores.edit', $item->id) }}" class="text-white bg-greenB hover:bg-greenG rounded-md p-2">Editar</a>
                                <form id="form-delete-{{ $item->id }}" 
                                    action="{{ route('proveedores.destroy', $item->id) }}" 
                                    method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $item->id }})" class="text-white bg-red-500 hover:bg-red-400 rounded-md py-1 px-2">Borrar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
            </table>
        @else
            <h2><b>No hay registros</b></h2>
        @endif
        <br>
        <div class="text-center">
            <a href="{{ route('proveedores.create') }}" class="bg-greenG hover:bg-greenB text-white p-2 rounded-lg">Añadir nueva proveedor</a>
        </div>
        
    </div>

    <div>{{ $proveedor->links() }}</div>
    

    <!-- Modal de confirmación (oculto por defecto) -->
    <div id="confirmation-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">
            <h2 class="text-xl font-bold text-red-700">¿Realmente quieres eliminar este proveedor?</h2>
            <p class="text-gray-700 mt-2">¡Esta acción no puede deshacerse!</p>
            <div class="flex justify-between mt-4">
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700 transition">Cancelar</button>
                <button id="confirm-delete" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-800 transition">Eliminar</button>
            </div>
        </div>
    </div>
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
</div>
