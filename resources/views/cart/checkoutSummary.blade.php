@extends('template.template')

@section('title', 'Verificar Pedido')

@section('content')
    <div class="container w-[90%] sm:w-[80%] md:w-[70] lg:w-[60%]  bg-white p-8 rounded-xl shadow-md">
        <h1 class="text-xl font-bold mb-4">Finalizar Compra<br>Paso 2: Resumen del Pedido</h1>

        {{-- Datos del Cliente --}}
        <h4 class="text-lg font-semibold">Datos del Cliente:</h4>
        <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
        <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
        <p><strong>Domicilio:</strong> {{ $cliente->direccion }}</p>
        <hr class="my-4">

        {{-- Datos del Pedido --}}
        <h4 class="text-lg font-semibold">Datos del Pedido:</h4>
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Producto</th>
                    <th class="border p-2">Cantidad</th>
                    <th class="border p-2">Valor Unidad</th>
                    <th class="border p-2">Valor Total</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($cart))
                @foreach($cart as $producto)
                    <tr>
                        <td class="border p-2">{{ $producto['name'] }}</td>
                        <td class="border p-2 text-center">{{ $producto['quantity'] }}</td>
                        <td class="border p-2 text-center">$ {{ number_format($producto['price']) }}</td>
                        <td class="border p-2 text-center">$ {{ number_format($producto['quantity'] * $producto['price']) }}</td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center p-4 text-red-500">No hay productos en el carrito</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <hr class="my-4">

        {{-- Datos del Costo --}}
        <h4 class="text-lg font-semibold">Datos del Costo:</h4>
        @php
            $subtotal = $total / 1.19;  // Valor sin IVA
            $iva = $total - $subtotal; // 19% del total
        @endphp
        <p><strong>Subtotal:</strong> $ {{ number_format($subtotal, 2) }}</p>
        <p><strong>IVA (19%):</strong> $ {{ number_format($iva, 2) }}</p>
        <p class="text-lg font-bold"><strong>Total del Pedido:</strong> $ {{ number_format($total) }}</p>

        {{-- Botón para Confirmar Pedido --}}
        <form action="{{ route('checkout.confirm') }}" method="POST">
            @csrf
            <button type="submit" class="bg-greenG hover:bg-greenB rounded-md text-white w-full mt-4 py-2">Pagar</button>
        </form>
    </div>
@endsection