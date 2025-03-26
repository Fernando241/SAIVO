@extends('template.template')

@section('title', 'Datos del Cliente')
    
@section('content')
<br>
    <div class="container w-[60%] bg-white rounded-xl p-6">
        <h1>Finalizar Compra<br>Paso 1: Datos del Cliente</h1><br>
        <p class="text-center text-sm">Los siguientes son datos necesarios para enviar su pedido con éxito</p><br>

        <form action="{{ route('cart.SaveDatasClient') }}" method="post">
            @csrf
            <div>
                <label for="nombre" class="block text-sm font-medium">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                    value="{{ old('nombre', $cliente ? $cliente->nombre : ($user ? $user->name : '')) }}" required>
            </div>

            <div>
                <label for="telefono" class="block text-sm font-medium">Teléfono:</label>
                <input type="text" name="telefono" id="telefono" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                    value="{{ old('telefono', $cliente ? $cliente->telefono : '') }}" required>
            </div>

            <div>
                <label for="direccion" class="block text-sm font-medium">Dirección:</label>
                <input type="text" name="direccion" id="direccion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                    value="{{ old('direccion', $cliente ? $cliente->direccion : '') }}" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium">Correo Electrónico:</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                    value="{{ old('email', $cliente ? $cliente->email : ($user ? $user->email : '')) }}" 
                    required>
            </div><br>

            <button type="submit" class="bg-greenG p-2 rounded-lg w-full hover:bg-greenB text-white">
                {{ $cliente ? 'Confirmar Datos' : 'Continuar' }}
            </button>
        </form>
    </div>
    
@endsection