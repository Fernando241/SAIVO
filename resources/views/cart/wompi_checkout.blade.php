@extends('template.template')

@section('title', 'Procesando Pago')

@section('content')

<div class="container w-[90%] sm:w-[80%] md:w-[60%] bg-white p-8 rounded-xl shadow-md text-center">

    <h1 class="text-2xl font-bold mb-4 text-green-800">
        Redirigiendo a plataforma de pago...
    </h1>

    <p class="mb-2"><b>Pedido:</b> #{{ $pedido->id }}</p>
    <p class="mb-2"><b>Cliente:</b> {{ $pedido->cliente->nombre }}</p>

    <div class="my-6">
        <h2 class="text-lg font-semibold mb-2">Resumen:</h2>

        @foreach ($pedido->detalles as $item)
            <p>
                {{ $item->producto->nombre }} 
                x{{ $item->cantidad }} → 
                COP {{ number_format($item->precio * $item->cantidad) }}
            </p>
        @endforeach
    </div>

    <hr class="my-4">

    <p class="text-xl font-bold text-green-700">
        Total: COP {{ number_format($pedido->total) }}
    </p>

    <p class="mt-6 text-gray-500">
        (Aquí conectaremos Wompi en el siguiente paso)
    </p>
</div>

@endsection