@extends('template.template')

@section('title', '¿Quienes somos?')
    
@section('content')
    <div class="container">
        <h1>¿Quienes somos?</h1>
        <h3 class="text-green-700 font-bold">Empresa:</h3><p><strong>Naturaleza Sagrada.SAS</strong></p><br>
        <p class="text-justify w-[90%] m-auto">Somos una empresa que reconoce la importancia de la sabiduria ancestral legada de generación en generación por nuestros indigenas, que reconocen que las plantas son seres vivos con bondades que provee nuestra madre naturaleza y que conectan con nuestros metabolismos para activar el <b>VIX-MEDICATRIX</b> que es la capacidad de nuestro cuerpo de autosanarse, autoregenerarse y autolimpiarse. Siendo esta la base fundamental de la filosofía ancestral. <br><br>Lo que pretendemos como empresa es destacar estos sabios conocimientos olvidados por la mayoria pero que siguen y seguiran siendo vigentes por generaciones ya que buscan promover el equilibro natural del metabolismo, siendo este un estado físico, mental y espiritual que nos permite no solo vernos sino especialmente sentirnos saludables.</p><br>

        <img src="{{ asset('img/indigena3.jpeg') }}" class="w-[60%] md:w-[40%] m-auto" alt="indigena"><br>

        <h3 class="text-green-700 font-bold text-center">Misión:</h3><br>
        <p class="text-justify w-[90%] m-auto">Como empresa estamos comprometidos con el bienestar, la salud y la integridad de la humanidad, compartiendo sabiduria ancestral no como remplazante o compentecia de la medicina moderna sino como coayudante en la recuperación, ya que los tratamientos basados en formulas indigenas son realmente alimentos que implementan ingredientes naturales que buscan la desintoxicación general del metabolismo en pro de devolver el equilibrio natural.</p><br>
        
        <h3 class="text-green-700 font-bold text-center">Visión:</h3><br>
        <p class="text-justify w-[90%] m-auto">Para el año 2034 buscamos consolidarnos como una empresa solida y respetada a nivel mundial en la promoción de tratamientos alternativos de origen ancestral, dando un espacio digno en la historia humana a la sabiduria de nuestros antepasados, premitiendo mantener vivo el recuerdo, honrar y preservar estos conocimientos que impulsan el verdadero valor, uso y cuidado de los recursos naturales de nuestra sagrada madre naturaleza.</p><br>
        
    </div>
@endsection