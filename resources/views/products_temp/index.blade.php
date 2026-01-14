@extends('template.template')

@section('title', 'Productos Exclusivos')
    
@section('content')
    <h1>Productos Exclusivos</h1><br>
    <h3 class="text-greenG text-center"><b>La Naturaleza y el Saber Tradicional en Cada Preparación Artesanal</b></h3><br>
    <div class="container text-center">
        <p class="p-4 text-justify">Descubre una línea de productos naturales artesanales elaborados con inspiración en saberes tradicionales y procesos manuales cuidadosamente desarrollados.<br><br>
            Cada preparación refleja una forma consciente de relacionarse con la naturaleza, priorizando ingredientes de origen natural, prácticas artesanales y una elaboración responsable en pequeñas cantidades.<br><br>
            No se trata de productos convencionales, sino de expresiones culturales y sensoriales pensadas para acompañar rituales de autocuidado, bienestar personal y conexión simbólica con lo natural. <br><br>
            Una invitación a valorar lo auténtico, lo artesanal y lo esencial, desde una experiencia respetuosa y consciente.
        </p>
    </div>
    <div class="container p-4">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($product as $product)
            <div class="bg-white rounded-xl">
                <div class="relative group">
                    <a href="{{ route('productos.show', $product->slug) }}" class="hover:opacity-80">
                        @if ($product->imagen)
                            <img src="{{ asset('storage/images/' . $product->imagen) }}" alt="{{ $product->nombre }}" class="w-full h-auto object-cover rounded-xl p-2">
                        @endif
                        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 transition-opacity group-hover:opacity-100">
                            <span class="text-white font-bold">Ver más</span>
                        </div>
                    </a>
                <h3 class="text-center text-green-900 font-bold">{{ $product->nombre }}</h3>
                <p class="text-center text-gray-600">{{ $product->presentacion }}</p>
                <h3 class="text-center font-bold">Precio: COP {{ number_format($product->precio_venta, 0, ',', '.') }}</h3>
                </div>
                <div class="text-center">
                    <form action="{{ route('cart.add', $product->id) }}" method="post">
                        @csrf
                        <button type="submit" class="m-2 bg-greenG text-white px-4 py-2 rounded hover:bg-greenB">Agregar al carrito</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div><br>
    <h2 class="text-green-900 text-center">Los productos ofrecidos por Naturaleza Sagrada S.A.S. BIC son elaboraciones artesanales de origen natural, sin finalidad terapéutica ni medicinal. No sustituyen tratamientos médicos ni diagnósticos profesionales. Su uso corresponde a prácticas tradicionales, culturales y de bienestar personal, conforme a la normativa colombiana vigente</h2><br>
    <img src="{{ asset('img/NaturalezaCiencia.jpg') }}" class="w-[60%] md:w-[40%] m-auto rounded-xl" alt="indigena">
@endsection