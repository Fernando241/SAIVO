<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    {{-- livewire Style --}}
    @livewireStyles
</head>

<body>
    <header class="grid grid-cols-8">
        <div class="bg-green-700 col-span-3 p-5">
            <h3>Barra de busqueda aquí</h3>
        </div>
        <div class="bg-green-700 col-span-4 p-5">
            <div>  
                @if (Route::has('login'))
                    <nav>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-white font-bold hover:text-yellow-200">Bienvenido, {{ auth()->user()->name }}</a>
                        @else
                            <a href="{{ route('login') }}" class="text-white hover:text-yellow-200 hover:font-bold mr-2">Iniciar Sesión</a>
        
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-white hover:text-yellow-200 hover:font-bold">Registrarse</a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </div>
    </div>
    <div class="col-span-1 col-start-8">
        <a href="{{ url('/cart') }}" class="text-white bg-green-700 p-4 w-40 fixed right-1 top-1 rounded-2xl hover:bg-green-400 hover:text-green-800 text-center"><i class='bx bxs-cart-alt'></i>@if(session('cart')) <span class="absolute top-0 right-0 bg-red-500 text-white rounded-full h-6 w-6 flex items-center justify-center"> {{ count(session('cart')) }} @else 0</span> @endif</a>
    </div>
    </header>

    {{-- Redes sociales flotantes --}}
    <a href="https://api.whatsapp.com/send?phone=573209909879" id="btn-ws" target="_blank"><i class='bx bxl-whatsapp'></i></a>
    <nav id="redes"> <!--iconos de redes sociales-->
        <a href="https://es-la.facebook.com/" id="icono" target="_black"><i class='bx bxl-facebook-circle'></i></a>
        <a href="https://www.youtube.com/" id="icono" target="_black"><i class='bx bxl-youtube'></i></a>
        <a href="https://www.instagram.com/?hl=en" id="icono" target="_black"><i class='bx bxl-instagram'></i></a>
        <a href="https://twitter.com/" id="icono" target="_black"><i class='bx bxl-twitter'></i></a>
    </nav>
    {{-- --- fin redes flotantes --- --}}

    
    <div class="bg-green-300">
        <div class="grid place-items-center bg-green-100">
            <div class="w-72 h-72">
                <img src="{{ asset('img/Logo.svg') }}" class="w-full h-full" alt="logo">
            </div>
        </div>
        <div>
        {{-- Menú de páginas --}}
            <hr>
                <nav id="menu">
                    <a href="{{ url('/') }}" class="nav_menu {{ request()->is('/') ? 'active' : '' }}">Inicio</a>
                    <a href="{{ url('/nosotros') }}" class="nav_menu {{ request()->is('nosotros') ? 'active' : '' }}">¿Quienes somos?</a>
                    <a href="{{ url('/productos') }}" class="nav_menu {{ request()->is('productos') ? 'active' : '' }}">Productos</a>
                    <a href="{{ url('/recetas') }}" class="nav_menu {{ request()->is('recetas') ? 'active' : '' }}">Recetas y Recomendaciones</a>
                </nav>
            <hr>
        </div><br>
        {{-- fin Menú de páginas --}}

        @yield('content')

        <br>
        <div>
            {{-- Menú de páginas --}}
                <hr>
                    <nav id="menu">
                        <a href="{{ url('/') }}" class="nav_menu {{ request()->is('/') ? 'active' : '' }}">Inicio</a>
                        <a href="{{ url('/nosotros') }}" class="nav_menu {{ request()->is('nosotros') ? 'active' : '' }}">¿Quienes somos?</a>
                        <a href="{{ url('/productos') }}" class="nav_menu {{ request()->is('productos') ? 'active' : '' }}">Productos</a>
                        <a href="{{ url('/recetas') }}" class="nav_menu {{ request()->is('recetas') ? 'active' : '' }}">Recetas y Recomendaciones</a>
                    </nav>
            </div>

        {{-- iconos de seguridad --}}


        <hr><br>

        <div class="flex flex-wrap md:flex-nowrap justify-center items-center">
            <img src="{{ asset('img/securePayment.png') }}" class="text-center w-[15%] md:w-[10%] m-5">
            <img src="{{ asset('img/payment.png') }}" class="text-center w-[15%] md:w-[10%] m-5">
            <img src="{{ asset('img/send.png') }}" class="text-center w-[15%] md:w-[10%] m-5">
            <img src="{{ asset('img/segureProduct.png') }}" class="text-center w-[15%] md:w-[10%] m-5">
        </div>
        <p class="text-center text-xs sm:text-sm md:text-base">Pagos Seguros | Modo de pago que elijas | Envios a todo el país | Productos Seguros</p><br>
        {{-- fin iconos de seguridad --}}

    </div>
    <footer class="w-full bg-green-700 text-center">
        <div class="container pt-5 mx-auto">
            <div class="flex flex-wrap md:flex-nowrap justify-center w-full">
                <div class="">
                    <div class=" bg-white p-5 rounded-full m-2">
                        <div class="w-32 h-32">
                            <img src="{{ asset('img/Logo.svg') }}" class="w-full h-full" alt="logo">
                        </div>
                    </div>
                </div>
                <div class="w-full text-white text-center p-2 m-2">
                    <h3 class="text-base font-bold">Información</h3><br>
                    <a href="{{ url('/') }}" class="text-xs hover:text-yellow-300">Inicio</a><br>
                    <a href="{{ url('/nosotros') }}" class="text-xs hover:text-yellow-300">¿Quienes somos?</a><br>
                    <a href="{{ url('/productos') }}" class="text-xs hover:text-yellow-300">Productos</a><br>
                    <a href="{{ url('/recetas') }}" class="text-xs hover:text-yellow-300">Recetas y Recomendaciones</a>
                </div>
                <div class="w-full text-white text-center p-2 m-2">
                    <h3 class="text-base font-bold">Políticas</h3>
                    <a href="#" class="text-xs hover:text-yellow-300">Políticas de Cookies</a><br>
                    <a href="#" class="text-xs hover:text-yellow-300">Política de Privacidad</a><br>
                    <a href="#" class="text-xs hover:text-yellow-300">Política de Devoluciones</a><br>
                    <a href="#" class="text-xs hover:text-yellow-300">Política de Términos y Condiciones</a><br>
                    <a href="#" class="text-xs hover:text-yellow-300">Preguntas Frecuentes</a>
                </div>
                <div class="w-full text-white text-center p-2 m-2">
                    <h3 class="text-base font-bold">Siguenos</h3><br>
                    <a href="https://api.whatsapp.com/send?phone=573204195115" target="_blank"><i class='bx bxl-whatsapp hover:text-yellow-300 m-2 text-[30px]'></i></a>
                    <a href="https://es-la.facebook.com/" target="_blank"><i class='bx bxl-facebook-circle hover:text-yellow-300 m-2 text-[30px]'></i></a>
                    <a href="https://www.youtube.com/" target="_blank"><i class='bx bxl-youtube hover:text-yellow-300 m-2 text-[30px]'></i></a>
                    <a href="https://www.instagram.com/?hl=en" target="_blank"><i class='bx bxl-instagram hover:text-yellow-300 m-2 text-[30px]'></i></a>
                </div>
            </div><br>
            </div>
            
        <p class=" text-white pb-5 text-xs md:text-base">&copy; 2024 Naturaleza Sagrada.SAS. Todos los derechos reservados.</p>
    </footer>

    {{-- livewire Script --}}
    @livewireScripts
</body>