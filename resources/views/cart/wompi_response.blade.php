@extends('template.template')

@section('title', 'Estado del Pago')

@section('content')
<div class="container text-center mt-10">
    <h1 class="text-2xl font-bold mb-4">Estado de tu pedido</h1>

    <p class="mb-2">Pedido #{{ $pedido->id }}</p>

    @if($pedido->estado == 'Pagado')
        <p class="text-green-600 font-bold text-lg">
            ✅ Pago confirmado correctamente
        </p>

    @elseif($pedido->estado == 'Fallido')
        <p class="text-red-600 font-bold text-lg">
            ❌ El pago fue rechazado o falló
        </p>

    @else
        <p class="text-yellow-600 font-bold text-lg">
            ⏳ Pago en verificación...
        </p>
    @endif

    <a href="{{ route('productos.index') }}" class="mt-6 inline-block bg-green-700 text-white px-4 py-2 rounded">
        Volver a la tienda
    </a>
</div>
@endsection