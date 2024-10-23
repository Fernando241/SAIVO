@extends('template.template')

@section('title', 'productos')
    
@section('content')
    <h1>Productos Exclusivos</h1><br>
    
    <div class="container">

        @foreach ($products as $product)
            <a href="#" class="w-[25%] md:w-[20%] relative group md: w-[60%]">
                <img src="{{ asset('img/'. $product->imagen) }}" alt="foto producto" class="w-[30%] md:w-[25%] relative group md: w-[50%]">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 transition duration-300 group-hover:opacity-100">
                    <span class="text-white text-lg">Ver más</span>
                </div>
                <h3 class="text-center mt-3 text-green-900 font-bold">{{ $product->nombre }}</h3>
            </a>
            </a>
        @endforeach
        {{-- <div class="flex flex-wrap justify-center items-center gap-5">
            <a href="#" class="w-[25%] md:w-[20%] relative group md: w-[60%]">
                <img src="{{ asset('img/extracto.jpg') }}" alt="Descripción" class="w-full h-auto object-cover rounded-xl transition duration-300 group-hover:opacity-70">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 transition duration-300 group-hover:opacity-100">
                    <span class="text-white text-lg">Ver más</span>
                </div>
                <h3 class="text-center mt-3 text-green-900 font-bold">Extracto Sagrado</h3>
            </a>
            <a href="#" class="w-[25%] md:w-[20%] relative group md: w-[60%]">
                <img src="{{ asset('img/limpieza.jpg') }}" alt="product2" class="w-full h-auto object-cover rounded-xl transition duration-300 group-hover:opacity-70">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 transition duration-300 group-hover:opacity-100">
                    <span class="text-white text-lg">Ver más</span>
                </div>
                <h3 class="text-center mt-3 text-green-900 font-bold">Limpieza Amazónica</h3>
            </a>
            <a href="#" class="w-[25%] md:w-[20%] relative group md: w-[60%]">
                <img src="{{ asset('img/milagroso.jpg') }}" alt="product3" class="w-full h-auto object-cover rounded-xl transition duration-300 group-hover:opacity-70">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 transition duration-300 group-hover:opacity-100">
                    <span class="text-white text-lg">Ver más</span>
                </div>
                <h3 class="text-center mt-3 text-green-900 font-bold">El Milagroso</h3>
            </a>
            <a href="#" class="w-[25%] md:w-[20%] relative group md: w-[60%]">
                <img src="{{ asset('img/potencia.jpg') }}" alt="product3" class="w-full h-auto object-cover rounded-xl transition duration-300 group-hover:opacity-70">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 transition duration-300 group-hover:opacity-100">
                    <span class="text-white text-lg">Ver más</span>
                </div>
                <h3 class="text-center mt-3 text-green-900 font-bold">Potencia Cacique</h3>
            </a>
            <a href="#" class="w-[25%] md:w-[20%] relative group md: w-[60%]">
                <img src="{{ asset('img/infusion.jpg') }}" alt="product3" class="w-full h-auto object-cover rounded-xl transition duration-300 group-hover:opacity-70">
                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 transition duration-300 group-hover:opacity-100">
                    <span class="text-white text-lg">Ver más</span>
                </div>
                <h3 class="text-center mt-3 text-green-900 font-bold">Infusión Ancestral</h3>
            </a> --}}
    </div><br>
    <h2 class="text-green-900 text-center">Los medicamentos homeopáticos magistrales y oficiales no requieren para su comercialización de registro sanitario. Decreto 1737 de 2005, Cap. IV Art. 11</h2><br>
    <img src="{{ asset('img/indigena1.jpeg') }}" class="w-[60%] md:w-[40%] m-auto" alt="indigena">
@endsection