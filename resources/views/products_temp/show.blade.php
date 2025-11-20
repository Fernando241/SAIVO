@extends('template.template')

{{-- 🔹 SEO dinámico --}}
@section('title', $product->nombre . ' | Naturaleza Sagrada')
@section('description', Str::limit(strip_tags($product->descripcion), 160))
@section('keywords', $product->nombre . ', productos naturales, herbolaria, Naturaleza Sagrada, bienestar, sabiduría indígena')
@section('canonical', url()->current())

{{-- 🔹 Datos estructurados JSON-LD --}}
@section('structured_data')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "{{ $product->nombre }}",
        "image": [
            "{{ asset('images/' . $product->imagen) }}"
        ],
        "description": "{{ Str::limit(strip_tags($product->descripcion), 200) }}",
        "sku": "{{ $product->id }}",
        "brand": {
            "@type": "Brand",
            "name": "Naturaleza Sagrada"
        },
        "offers": {
            "@type": "Offer",
            "url": "{{ url()->current() }}",
            "priceCurrency": "COP",
            "price": "{{ $product->precio_venta }}",
            "itemCondition": "https://schema.org/NewCondition",
            "availability": "{{ $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
            "seller": {
            "@type": "Organization",
            "name": "Naturaleza Sagrada"
            }
        }
    }
    </script>
@endsection

{{-- 🔹 Contenido visual --}}
@section('content')
    <br>
    <div class="text-center">
        <a href="{{ route('productos.index') }}" class="bg-greenB hover:bg-greenG px-4 py-2 text-white rounded-lg">Volver a Productos</a>
    </div><br>

    <div class="container bg-white w-[90%] sm:w-[70%] rounded-xl p-4">
        <h1 class="text-2xl font-bold text-green-900 mb-4">{{ $product->nombre }}</h1>

        <div class="block lg:flex">
            <div class="w-full lg:w-1/2 p-4">
                <img src="{{ asset('images/' . $product->imagen) }}" alt="{{ $product->nombre }}" class="rounded-xl w-full">
            </div>
            <div class="w-full lg:w-1/2 p-4">
                <p class="font-bold">Presentación:</p>
                <p class="text-justify">{{ $product->presentacion }}</p>

                <p class="font-bold mt-3">Componentes:</p>
                <p class="text-justify">{{ $product->componentes }}</p>

                <p class="font-bold">Descripción:</p>
                <p class="text-justify">{{ $product->descripcion }}</p>

                <p class="font-bold mt-3">Indicaciones:</p>
                <p class="text-justify">{{ $product->indicaciones }}</p>

                <p class="font-bold mt-3">Contraindicaciones:</p>
                <p class="text-justify">{{ $product->contraindicaciones }}</p>
            </div>
        </div>

        <div class="flex mt-4">
            <div class="w-1/2">
                <p class="font-bold text-center">Stock:</p>
                <p class="text-center text-2xl text-green-900">{{ $product->stock }}</p>
            </div>
            <div class="w-1/2">
                <p class="font-bold text-center">Precio de venta:</p>
                <p class="text-center text-2xl text-green-900">COP {{ number_format($product->precio_venta, 0, ',', '.') }}</p>
            </div>
        </div><br>

        <div class="text-center">
            <form action="{{ route('cart.add', $product->id) }}" method="post">
                @csrf
                <button type="submit" class="m-2 bg-greenG text-white px-4 py-2 rounded hover:bg-greenB">Agregar al carrito</button>
            </form>
        </div>
    </div><br>

    <div class="text-center">
        <a href="{{ route('productos.index') }}" class="bg-greenB hover:bg-greenG px-4 py-2 text-white rounded-lg">Volver</a>
    </div><br>
@endsection
