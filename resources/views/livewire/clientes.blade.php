<div>
    <br>
    <h1>Lista de clientes</h1><br>
    <div class="container w-[90%]">
        <div class="text-center">
            <input 
            wire:model="search"
            wire:keyup="buscarClientes" 
            class="w-[70%] rounded-md" 
            placeholder="Ingrese el nombre o correo del cliente">
        </div><br>

        @if (count($clientes))
            <table>
            <thead>
                <tr class="bg-greenB text-white">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th class="hidden md:table-cell">Correo electrónico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cliente as $item)
                    <tr class="p-4 hover:border border-slate-500">
                        <td class="text-center">{{ $item->id }}</td>
                        <td class="text-center">{{ $item->nombre }}</td>
                        <td class="text-center">{{ $item->telefono }}</td>
                        <td class="text-center hidden md:table-cell">{{ $item->email }}</td>
                        <td>
                            <div class="text-center m-1 flex justify-center">
                                <a href="{{ route('clientes.show', $item->id) }}" class="bg-greenG py-1 px-4 rounded-md hover:bg-greenB text-white">Ver</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        @else
            <h2><b>No hay registros</b></h2>
        @endif
        <div class="bg-greenG w-full h-10"></div>
    </div>
    <div>{{ $cliente->links() }}</div>
    
</div>
