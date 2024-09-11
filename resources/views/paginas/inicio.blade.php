<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
    <br>
    <div class="container mx-auto">
        <header>
            @if (Route::has('login'))
                <nav>
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" style="padding: 10px">Iniciar Sesión</a>
    
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" style="padding: 10px">Registrarse</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
    </div>
    
    <br>
    <hr>
    <br>
    <div class="container mx-auto">
        <h1><b>Bienvenido a la Aplicación SAIVO</b></h1><br>
        <p>Esta es la página de inicio de la aplicación diseñada para la empresa <b>Naturaleza Sagrada</b></p>
        <div class="grid grid-cols-4 gap-2">
            <div class="bg-blue-100">a</div>
            <div class="bg-blue-300">b</div>
            <div class="bg-green-400 col-span-2 row-span-3">c</div>
            <div class="bg-blue-500">d</div>
            <div class="bg-green-600 row-span-2">e</div>
            <div class="bg-green-700 col-start-1">f</div>
        </div>
    </div>
</body>
</html>