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
        
    <div class="container">
        <div class="flex flex-wrap justify-center items-center gap-5">
            <div class="w-[25%] md:w-[20%]">
                <img src="{{ asset('img/extracto.jpg') }}" alt="product1" class="w-full h-auto object-cover">
                <h3 class="text-center mt-3 text-green-900 font-bold">Extracto Sagrado</h3>
            </div>
            <div class="w-[25%] md:w-[20%]">
                <img src="{{ asset('img/limpieza.jpg') }}" alt="product2" class="w-full h-auto object-cover">
                <h3 class="text-center mt-3 text-green-900 font-bold">Limpieza Amazónica</h3>
            </div>
            <div class="w-[25%] md:w-[20%]">
                <img src="{{ asset('img/milagroso.jpg') }}" alt="product3" class="w-full h-auto object-cover">
                <h3 class="text-center mt-3 text-green-900 font-bold">El Milagroso</h3>
            </div>
            <div class="w-[25%] md:w-[20%]">
                <img src="{{ asset('img/potencia.jpg') }}" alt="product3" class="w-full h-auto object-cover">
                <h3 class="text-center mt-3 text-green-900 font-bold">Potencia Cacique</h3>
            </div>
            <div class="w-[25%] md:w-[20%]">
                <img src="{{ asset('img/infusion.jpg') }}" alt="product3" class="w-full h-auto object-cover">
                <h3 class="text-center mt-3 text-green-900 font-bold">Infusión Ancestral</h3>
            </div>
    </div><br>
    <h2 class="text-green-900 text-center">Los medicamentos homeopáticos magistrales y oficiales no requieren para su comercialización de registro sanitario. Decreto 1737 de 2005, Cap. IV Art. 11</h2>
@endsection
