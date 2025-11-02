@extends('template.template')

@section('title', '¿Quienes somos?')
    
@section('content')
    <div class="container">
    <h1>¿Quiénes Somos?</h1><br>

    <div class="text-center text-lg">
        <h3 class="text-green-700 font-bold">Empresa:</h3>
        <p><strong>Naturaleza Sagrada S.A.S.</strong></p><br>
    </div>

    <p class="text-justify w-[90%] m-auto">
        En <b>Naturaleza Sagrada</b> reconocemos y honramos la <b>sabiduría ancestral</b> transmitida por nuestros pueblos indígenas, guardianes del conocimiento natural y del equilibrio entre el ser humano y la Tierra.  
        <br><br>
        Creemos que las plantas son aliadas vivas que la naturaleza nos ofrece para promover la <b>armonía integral del cuerpo, la mente y el espíritu</b>. Cada una de nuestras preparaciones es elaborada artesanalmente con ingredientes naturales seleccionados, inspirados en estas enseñanzas milenarias.  
        <br><br>
        Nuestro propósito es rescatar y compartir esos saberes que promueven un estilo de vida más consciente, natural y conectado con el entorno. Buscamos inspirar bienestar y equilibrio interior desde el respeto, la gratitud y la armonía con la Madre Tierra.
    </p>
    <br>

    <img src="{{ asset('img/laboratorio.jpg') }}" class="w-[60%] md:w-[40%] m-auto rounded-xl" alt="sabiduría indígena ancestral"><br>

    <h3 class="text-green-700 font-bold text-center">Misión</h3><br>
    <p class="text-justify w-[90%] m-auto">
        Contribuir al <b>bienestar integral de las personas</b> mediante productos naturales elaborados artesanalmente, inspirados en tradiciones indígenas y en la filosofía del equilibrio con la naturaleza.  
        <br><br>
        Nuestro compromiso es ofrecer alternativas naturales que acompañen hábitos de vida saludables, siempre desde una visión de respeto hacia la medicina moderna, la biodiversidad y el conocimiento ancestral.
    </p>
    <br>

    <h3 class="text-green-700 font-bold text-center">Visión</h3><br>
    <p class="text-justify w-[90%] m-auto">
        Para el año <b>2034</b>, aspiramos a consolidarnos como una empresa reconocida a nivel nacional e internacional por su aporte a la preservación y difusión de la sabiduría ancestral indígena, promoviendo el uso consciente y responsable de los recursos naturales.  
        <br><br>
        Deseamos ser un referente en la integración de lo ancestral y lo contemporáneo, ofreciendo productos que inspiren respeto, conexión y gratitud hacia nuestra sagrada Madre Naturaleza.
    </p>
    <br>
</div>

@endsection