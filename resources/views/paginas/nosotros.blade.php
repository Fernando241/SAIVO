@extends('template.template')

@section('title', '¿Quienes somos?')
    
@section('content')
    <div class="container">
    <h1>¿Quiénes Somos?</h1><br>

    <div class="text-center text-lg">
        <h3 class="text-green-700 font-bold">Empresa:</h3>
        <p><strong>Naturaleza Sagrada S.A.S. BIC</strong><br>NIT 902017015-7 <br>Colombia</p><br>
    </div>

    <p class="text-justify w-[90%] m-auto">
        En <b>Naturaleza Sagrada</b> reconocemos y valoramos los saberes tradicionales transmitidos por pueblos indígenas, como expresiones culturales que reflejan una relación respetuosa entre el ser humano y la naturaleza.  
        <br><br>
        Nuestro trabajo se inspira en la observación consciente de las plantas y en prácticas artesanales que resaltan su valor simbólico, sensorial y cultural. Cada preparación es elaborada de manera manual, en pequeñas cantidades, utilizando ingredientes de origen natural cuidadosamente seleccionados.
        <br><br>
        Nuestro propósito es rescatar y compartir conocimientos que promuevan un estilo de vida más consciente, responsable y conectado con el entorno, desde el respeto por la diversidad cultural, la biodiversidad y los procesos naturales.
        <br><br>
        Buscamos inspirar experiencias de autocuidado y bienestar personal desde una visión cultural, consciente y no terapéutica, en armonía con la naturaleza y el respeto por el conocimiento contemporáneo.
    </p>
    <br>

    <img src="{{ asset('img/NaturalezaCiencia.jpg') }}" class="w-[60%] md:w-[40%] m-auto rounded-xl" alt="sabiduría indígena ancestral"><br>

    <h3 class="text-green-700 font-bold text-center">Misión</h3><br>
    <p class="text-justify w-[90%] m-auto">
        Contribuir al bienestar personal y al autocuidado consciente mediante productos naturales elaborados artesanalmente, inspirados en tradiciones culturales y en una relación respetuosa con la naturaleza.  
        <br><br>
        Nuestro compromiso es ofrecer alternativas responsables que acompañen hábitos de vida saludables, reconociendo y respetando el papel de la medicina moderna, la biodiversidad y el conocimiento ancestral como expresiones complementarias.
    </p>
    <br>

    <h3 class="text-green-700 font-bold text-center">Visión</h3><br>
    <p class="text-justify w-[90%] m-auto">
        Para el año <b>2034</b>, aspiramos a consolidarnos como una empresa reconocida a nivel nacional e internacional por su aporte a la valoración cultural de los saberes tradicionales y por la promoción de prácticas de consumo consciente y responsable de los recursos naturales.  
        <br><br>
        Deseamos ser un referente en la integración respetuosa de lo ancestral y lo contemporáneo, inspirando conexión, gratitud y respeto hacia la naturaleza.
    </p>
    <br>
</div>

@endsection