<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Naturaleza Sagrada') }}
        </h2>
    </x-slot>

    @livewire('dynamic-content')

    <div class="container w-[80%]">
        <br>
        <div class="text-right">
            <a href="{{ route('users.index') }}" class="bg-greenG py-2 px-6 hover:bg-greenB text-white rounded-md">Volver</a>
        </div>
        <h1>Editar usuario</h1><br>
        <p class="text-sm font-medium text-gray-700">Nombre:</p>
        <h3 class="bg-white p-2 rounded-md border border-gray-700">{{ $user->name }}</h3><br>
        <h2>Listado de roles</h2>
        <form action="{{ route('users.update', $user) }}" method="POST" id="solicitudForm">
            @csrf
            @method('PUT')
            @foreach ($roles as $role)
                <div>
                    <label>
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                        {{ $role->name }}
                    </label>
                </div>
            @endforeach
            <div class="text-center">
                <button type="submit" class="py-2 px-8 bg-greenG hover:bg-greenB text-white font-bold rounded-md">Asignar rol</button>
            </div>
        </form>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('solicitudForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir el envío del formulario
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'roles para {{ $user->name }} asignados con exito!',
                showConfirmButton: false,
                timer: 1500
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    // Enviar el formulario después de mostrar la alerta
                    event.target.submit();
                }
            });
        });
</script>