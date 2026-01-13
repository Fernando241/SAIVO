@extends('template.template')

{{-- 🔹 SEO dinámico --}}
@section('canonical', url()->current())
@section('title', $product->nombre . ' | Naturaleza Sagrada')
@section('og_type', 'product')
@section('og_image', asset('storage/images/' . $product->imagen))
@section('twitter_image', asset('storage/images/' . $product->imagen))
@section('description', Str::limit(strip_tags($product->descripcion), 160))
@section('keywords', $product->nombre . ', productos naturales, herbolaria, Naturaleza Sagrada, bienestar, sabiduría indígena')


{{-- 🔹 Datos estructurados JSON-LD --}}
@section('structured_data')
<script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": @json($product->nombre),
        "image": [
            @json(asset('storage/images/' . $product->imagen))
        ],
        "description": @json(Str::limit(strip_tags($product->descripcion), 200)),
        "sku": @json($product->id),
        "brand": {
            "@type": "Brand",
            "name": "Naturaleza Sagrada"
        },
        "offers": {
            "@type": "Offer",
            "url": @json(url()->current()),
            "priceCurrency": "COP",
            "price": @json($product->precio_venta),
            "itemCondition": "https://schema.org/NewCondition",
            "availability": "{{ $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
            "seller": {
            "@type": "Organization",
            "name": "Naturaleza Sagrada"
            },
            "hasMerchantReturnPolicy": {
            "@type": "MerchantReturnPolicy",
            "returnPolicyCategory": "https://schema.org/MerchantReturnFiniteReturnWindow",
            "merchantReturnDays": 5,
            "returnMethod": "https://schema.org/ReturnByMail",
            "applicableCountry": "CO"
            },
            "shippingDetails": {
                "@type": "OfferShippingDetails",
                "shippingRate": {
                    "@type": "MonetaryAmount",
                    "value": "0",
                    "currency": "COP"
                },
                "shippingDestination": {
                    "@type": "DefinedRegion",
                    "addressCountry": "CO"
                },
                "deliveryTime": {
                    "@type": "ShippingDeliveryTime",
                    "handlingTime": {
                    "@type": "QuantitativeValue",
                    "minValue": 0,
                    "maxValue": 1,
                    "unitCode": "DAY"
                    },
                    "transitTime": {
                    "@type": "QuantitativeValue",
                    "minValue": 1,
                    "maxValue": 3,
                    "unitCode": "DAY"
                    }
                }
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
                @if ($product->imagen)
                    <img 
                        src="{{ asset('storage/images/' . $product->imagen) }}" 
                        alt="{{ $product->nombre }} - Producto natural artesanal de Naturaleza Sagrada SAS" 
                        width="800"
                        height="800"
                        class="rounded-xl w-full">
                @endif
            </div>
            <div class="w-full lg:w-1/2 p-4">
                <p class="font-bold">Presentación:</p>
                <p class="text-justify">{{ $product->presentacion }}</p>

                <p class="font-bold mt-3">Ingredientes:</p>
                <p class="text-justify">{{ $product->componentes }}</p>

                <p class="font-bold">Descripción:</p>
                <p class="text-justify">{{ $product->descripcion }}</p>

                <p class="font-bold mt-3">Forma de uso:</p>
                <p class="text-justify">{{ $product->indicaciones }}</p>

                <p class="font-bold mt-3">Advertencias, precauciones y contraindicaciones:</p>
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
                <button type="submit" class="btn-cart m-2 bg-greenG text-white px-4 py-2 rounded hover:bg-greenB">Agregar <br> al carrito</button>
            </form>
        </div>
    </div><br>

    <div class="text-center">
        <a href="{{ route('productos.index') }}" class="bg-greenB hover:bg-greenG px-4 py-2 text-white rounded-lg">Volver</a>
    </div><br>
@endsection
