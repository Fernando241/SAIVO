@extends('template.template')

@section('title', 'inicio')
    
@section('content')
    <h1>Reconecta con la Sabiduría Ancestral y el Poder Natural</h1>
    <br>
    <div class="container flex flex-wrap md:flex-nowrap justify-center items-center">
        <img src="{{ asset('img/paraIndex.jpg') }}" class="w-[80%] md:w-[40%] rounded-xl" alt="indigena">
        <div class="w-[90%] md:w-[40%]">
            <br>
            <h2 class="font-bold text-center">Artesania natural inspirada en tradiciones indígenas</h2>
            <br>
            <p class="text-justify ml-10">En 
                <strong>Naturaleza Sagrada SAS</strong>, honramos la sabiduria ancestral a través de productos naturales artesanales elaborados con respeto por la tierra y las tradiciones indigenas.<br>
                Cada preparación es una expresión de conexión espiritual con la naturaleza, creada en pequeñas cantidades para preservar su pureza y esencia original.<br><br>
                Nuestros productos están pensados para acompañarte en tu camino hacia el bienestar integral, el equilibrio energético y la armonía personal, desde una visión natural y consciente.<br><br>
                Te invitamos a redescubrir el valor de lo auténtico, lo artesal y lo sagrado en cada gota, aroma y textura.</p>
        </div>
    </div>
    <br>
    <br><hr><br>

    <h2 class="text-green-900 text-center font-bold">Descubre nuestras preparaciones naturales más apreciadas</h2><br>
        
    <div class="container p-4">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($products as $product)
            <div class="bg-white rounded-xl">
                <div class="relative group">
                    <a href="{{ route('productos.show', $product->slug) }}" class="hover:opacity-80">
                        <img src="{{ asset('images/' . $product->imagen) }}" alt="{{ $product->nombre }} producto natural artesanal" class="w-full h-auto object-cover rounded-xl p-2">
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
                        <button type="submit" class="m-2 bg-greenG text-white px-4 py-2 rounded hover:bg-greenB">Agregar al carrito</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <h2 class="text-green-900 text-center">
        Los productos naturales artesanales y las prepaparaciones tradicionales no sustituyen tratamientos médicos y no requieren registro sanitario INVIMA conforme al Decreto 1737 de 2005, Cap. IV Art. 11
        
    </div><br>
    
@endsection