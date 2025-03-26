<div class="container w-[80%]">
    <h1>Lista de Usuarios</h1>
    <div class="text-center">
        <input wire:model="search"
        wire:keyup="buscarUsuarios"
        class="w-[80%] rounded-md" 
        placeholder="Ingrese el nombre o correo del usuario">
    </div><br>

    @if (count($users))
        <table class="table">
            <thead>
                <tr class="bg-greenB text-white">
                    <th>Id</th>
                    <th>Nombre</th>
                    <th class="hidden sm:table-cell">Correo electrónico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $item)
                    <tr class="p-4 hover:border border-slate-500">
                        <td class="text-center">{{ $item->id }}</td>
                        <td class="text-center">{{ $item->name }}</td>
                        <td class="text-center hidden sm:table-cell">{{ $item->email }}</td>
                        <td class="text-center flex justify-center">
                            <a href="{{ route('users.edit', $item->id) }}" class="text-white bg-greenG hover:bg-greenB rounded-md py-1 px-2">Editar Rol</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h2><b>No hay registros</b></h2>
    @endif

    <div>{{ $user->links() }}</div>
</div>
