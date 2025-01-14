@extends('template.template')

@section('title', 'inicio')
    
@section('content')
    <h1>Descubra la Sabiduria Ancestral en cada uno de Nuestros Productos</h1>
    <br>
    <div class="container flex flex-wrap md:flex-nowrap justify-center items-center">
        <img src="{{ asset('img/indigena4.jpeg') }}" class="w-[70%] md:w-[40%]" alt="indigena">
        <div class="w-[90%] md:w-[40%]">
            <br>
            <h2 class="font-bold text-center">La Sabiduria Ancestral de los Indigenas</h2>
            <br>
            <p class="text-justify ml-10">En <b>Naturaleza Sagrada</b>, nos enorgullece ofrecerte tratamientos elaborados con fórmulas indígenas ancestrales, fórmulas transmitidas de generación en generación. Donde con orgullo podemos decir que cada una de nuestras recetas es un homenaje a la naturaleza y la sabiduría de nuestros antepasados, ya que sus ingredientes son cuidadosamente seleccionados y preparados para brindarte bienestar y conexión con nuestras raíces.<br> Te invitamos a unirte a nosotros en este viaje hacia una vida más saludable y equilibrada, respetando y honrando las tradiciones que nos han sido legadas.</p>
        </div>
    </div>
    <br>
    <br><hr><br>

    <h2 class="text-green-900 text-center font-bold">Estos son algunos de nuestros productos con mayores testimonios</h2><br>
        
    <div class="container p-4">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($products as $product)
            <div class="bg-white rounded-xl">
                <a href="{{ route('productos.show', $product->id) }}" class="hover:opacity-80">
                    <img src="{{ asset('images/' . $product->imagen) }}" alt="{{ $product->nombre }}" class="w-full h-auto object-cover rounded-xl p-2">
                </a>
                <h3 class="text-center text-green-900 font-bold">{{ $product->nombre }}</h3>
                <p class="text-center text-gray-600">{{ $product->presentacion }}</p>
                <h3 class="text-center font-bold">Precio: $ {{ number_format($product->precio_venta, 0, ',', '.') }}</h3>
                <div class="text-center">
                    <button class="m-2 bg-green-700 text-white px-4 py-2 rounded hover:bg-green-600">Agregar al carrito</button>
                </div>
            </div>
            @endforeach
        </div>
    </div><br>
    <h2 class="text-green-900 text-center">Los medicamentos homeopáticos magistrales y oficiales no requieren para su comercialización de registro sanitario. Decreto 1737 de 2005, Cap. IV Art. 11</h2>
@endsection
