@extends('template.template')

@section('title', 'productos')
    
@section('content')
    <h1>Productos Exclusivos</h1><br>
    
    <div class="container">
        <div class="flex flex-wrap justify-center items-center gap-5">
            <div class="w-[25%] md:w-[20%]">
                <img src="{{ asset('img/extracto.jpg') }}" alt="product1" class="w-full h-auto object-cover rounded-xl">
                <h3 class="text-center mt-3 text-green-900 font-bold">Extracto Sagrado</h3>
            </div>
            <div class="w-[25%] md:w-[20%]">
                <img src="{{ asset('img/limpieza.jpg') }}" alt="product2" class="w-full h-auto object-cover rounded-xl">
                <h3 class="text-center mt-3 text-green-900 font-bold">Limpieza Amazónica</h3>
            </div>
            <div class="w-[25%] md:w-[20%]">
                <img src="{{ asset('img/milagroso.jpg') }}" alt="product3" class="w-full h-auto object-cover rounded-xl">
                <h3 class="text-center mt-3 text-green-900 font-bold">El Milagroso</h3>
            </div>
            <div class="w-[25%] md:w-[20%]">
                <img src="{{ asset('img/potencia.jpg') }}" alt="product3" class="w-full h-auto object-cover rounded-xl">
                <h3 class="text-center mt-3 text-green-900 font-bold">Potencia Cacique</h3>
            </div>
            <div class="w-[25%] md:w-[20%]">
                <img src="{{ asset('img/infusion.jpg') }}" alt="product3" class="w-full h-auto object-cover rounded-xl">
                <h3 class="text-center mt-3 text-green-900 font-bold">Infusión Ancestral</h3>
            </div>
    </div><br>
    <h2 class="text-green-900 text-center">Los medicamentos homeopáticos magistrales y oficiales no requieren para su comercialización de registro sanitario. Decreto 1737 de 2005, Cap. IV Art. 11</h2><br>
    <img src="{{ asset('img/indigena1.jpeg') }}" class="w-[60%] md:w-[40%] m-auto" alt="indigena">
@endsection