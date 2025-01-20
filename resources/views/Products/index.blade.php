@extends('template.template')

@section('title', 'productos')
    
@section('content')
    <h1>Productos Exclusivos</h1><br>
    


    <div class="container p-4">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($product as $product)
            <div class="bg-white rounded-xl">
                <div class="relative group">
                    <a href="{{ route('productos.show', $product->id) }}" class="hover:opacity-80">
                        <img src="{{ asset('images/' . $product->imagen) }}" alt="{{ $product->nombre }}" class="w-full h-auto object-cover rounded-xl p-2">
                        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 transition-opacity group-hover:opacity-100">
                            <span class="text-white font-bold">Ver más</span>
                        </div>
                    </a>
                <h3 class="text-center text-green-900 font-bold">{{ $product->nombre }}</h3>
                <p class="text-center text-gray-600">{{ $product->presentacion }}</p>
                <h3 class="text-center font-bold">Precio: $ {{ number_format($product->precio_venta, 0, ',', '.') }}</h3>
                </div>
                <div class="text-center">
                    <form action="{{ route('cart.add', $product->id) }}" method="post">
                        @csrf
                        <button type="submit" class="m-2 bg-green-700 text-white px-4 py-2 rounded hover:bg-green-600">Agregar al carrito</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div><br>
    <h2 class="text-green-900 text-center">Los medicamentos homeopáticos o con base en fórmulas magistrales no requieren para su comercialización de registro sanitario. <br> Decreto 1737 de 2005, Cap. IV Art. 11</h2><br>
    <img src="{{ asset('img/indigena1.jpeg') }}" class="w-[60%] md:w-[40%] m-auto" alt="indigena">
@endsection