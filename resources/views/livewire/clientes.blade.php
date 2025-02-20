<div>
    <h1>Lista de clientes</h1><br>
    <div class="container">
        <div>
            <input 
            wire:model="search"
            wire:keyup="buscarClientes" 
            class="w-full rounded-md" 
            placeholder="Ingrese el nombre o correo del cliente">
        </div><br>

        @if (count($clientes))
            <table>
            <thead>
                <tr class="bg-greenB text-white">
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th class="hidden lg:table-cell">Dirección</th>
                    <th class="hidden md:table-cell">Correo electrónico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cliente as $item)
                    <tr class="p-4 hover:border border-slate-500">
                        <td class="text-center">{{ $item->nombre }}</td>
                        <td class="text-center">{{ $item->telefono }}</td>
                        <td class="text-center hidden lg:table-cell">{{ $item->direccion }}</td>
                        <td class="text-center hidden md:table-cell">{{ $item->email }}</td>
                        <td class="flex justify-center">
                            <a href="{{ route('clientes.edit', $item->id) }}" class=" text-white bg-greenG hover:bg-greenB rounded-md p-2">Editar</a>
                            <form action="{{ route('clientes.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white bg-red-500 hover:bg-red-400 rounded-md p-2 ml-2">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        @else
            <h2><b>No hay registros</b></h2>
        @endif
    </div>
    <div>{{ $cliente->links() }}</div>
</div>
