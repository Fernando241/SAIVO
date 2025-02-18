<div class="container">
    <div>
        <input wire:model="search" class="w-full rounded-md" placeholder="Ingrese el nombre o correo del usuario">
    </div><br>
    {{-- Tabla para mostrar los usuarios registrados --}}
    <table class="table">
        <thead>
            <tr class="bg-greenB text-white">
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="p-4 hover:border border-slate-500">
                    <td class="text-center">{{ $user->id }}</td>
                    <td class="text-center">{{ $user->name }}</td>
                    <td class="text-center">{{ $user->email }}</td>
                    <td class="text-center flex justify-center">
                        <a href="{{ route('users.edit', $user->id) }}" class="text-white bg-greenG hover:bg-greenB rounded-md p-2">Editar</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white bg-red-500 hover:bg-red-400 rounded-md p-2 ml-2">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>{{ $users->links() }}</div>
</div>
