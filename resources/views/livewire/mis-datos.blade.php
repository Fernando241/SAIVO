<div class="container">
    <h1>Mis Datos</h1>
    <br>
    <a href="{{ route('profile.show') }}" class="p-2 bg-greenG hover:bg-greenB text-white rounded-xl">Editar Perfil</a>
    <a href="{{ route('clientes.show', $cliente->id) }}" class="bg-greenG py-1 px-4 rounded-md hover:bg-greenB text-white">Ver</a>
</div>
