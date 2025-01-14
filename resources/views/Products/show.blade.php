@extends('template.template')

@section('title', 'producto')

@section('content')
    <h1>Detalles de producto</h1>
    <div class="container p-4">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="m-auto">
                <img src="{{ asset('images/' . $product->imagen) }}" alt="{{ $product->nombre }}" class="w-96 h-auto object-cover rounded-2xl">
            </div>
            <div class="bg-green-100 p-4 rounded-2xl">
                <h1 class="text-center text-green-900 font-bold">{{ $product->nombre }}</h1><br>
                <h3>Presentación:</h3>
                <p class="text-gray-600">{{ $product->presentacion }}</p><br>
                <h3>Componentes:</h3>
                <p class="text-gray-600">{{ $product->componentes }}</p><br>
                <h3>Descripción:</h3>
                <p class="text-gray-600">{{ $product->descripcion }}</p><br>
                <h3>Indicaciones:</h3>
                <p class="text-gray-600">{{ $product->indicaciones }}</p><br>
                <h3>Contraindicaciones:</h3>
                <p class="text-gray-600">{{ $product->contraindicaciones }}</p><br>
                <h3 class="font-bold">Unidades disponibles: {{ $product->stock }}</h3><br>
                <h3 class="font-bold text-lg">Precio: $ {{ number_format($product->precio_venta, 0, ',', '.') }}</h3>
                <div class="text-center">
                    <button class="m-2 bg-green-700 text-white px-4 py-2 rounded hover:bg-green-600">Agregar al carrito</button>
                </div>
            </div>
        </div>
    </div><br>
    <h2 class="text-green-900 text-center">Los medicamentos homeopáticos o con base en fórmulas magistrales no requieren para su comercialización de registro sanitario. <br> Decreto 1737 de 2005, Cap. IV Art. 11</h2><br>
@endsection