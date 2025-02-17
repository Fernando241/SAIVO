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
    <header>
        <div class="bg-greenG p-1 text-center">
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
        {{-- Barra de busqueda --}}
        <div class="bg-greenG p-1 text-center">
            <livewire:busqueda-productos />

        </div>

        <div class="col-span-1 relative">
            <a href="{{ url('/cart') }}" class="text-white bg-greenB p-4 w-20 md:w-40 fixed right-1 top-1 rounded-2xl hover:bg-greenY hover:text-greenG text-center z-50">
                <i class='bx bxs-cart-alt'></i>
                <span class="absolute top-0 right-0 bg-red-500 text-white rounded-full h-6 w-6 flex items-center justify-center">
                    {{ session('cart') ? app('App\Http\Controllers\CartController')->getTotalItemsInCart() : 0 }}
                </span>
            </a>
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

    {{-- alertas en páginas que heredan de esta plantilla --}}
    @if(session('success')) 
        <div x-data="{ show: true }" 
            x-show="show" 
            x-init="setTimeout(() => show = false, 2000)" 
            class="fixed top-32 md:top-20 right-5 bg-greenB text-white px-4 py-3 rounded-lg shadow-lg">
            <strong class="font-bold">¡Éxito!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- logo de la empresa --}}
    <div class="bg-green-200">
        <div class="grid place-items-center bg-white pt-16">
            <div class="p-2">
                <img src="{{ asset('img/logonatsag.svg') }}" alt="logo">
            </div>
        </div>
        
        <div class="bg-greenB">
        {{-- Menú de páginas --}}
            
                <nav id="menu">
                    <a href="{{ url('/') }}" class="nav_menu {{ request()->is('/') ? 'active' : '' }}">Inicio</a>
                    <a href="{{ url('/productos') }}" class="nav_menu {{ request()->is('productos') ? 'active' : '' }}">Nuestros Productos</a>
                    <a href="{{ url('/nosotros') }}" class="nav_menu {{ request()->is('nosotros') ? 'active' : '' }}">¿Quienes somos?</a>
                    <a href="{{ url('/recetas') }}" class="nav_menu {{ request()->is('recetas') ? 'active' : '' }}">Recetas y Recomendaciones</a>
                </nav>
            
        </div><br>
        {{-- fin Menú de páginas --}}

        @yield('content')

        <br>
        <div class="bg-greenB">
            {{-- Menú de páginas --}}
                <nav id="menu">
                    <a href="{{ url('/') }}" class="nav_menu {{ request()->is('/') ? 'active' : '' }}">Inicio</a>
                    <a href="{{ url('/productos') }}" class="nav_menu {{ request()->is('productos') ? 'active' : '' }}">Nuestros Productos</a>
                    <a href="{{ url('/nosotros') }}" class="nav_menu {{ request()->is('nosotros') ? 'active' : '' }}">¿Quienes somos?</a>
                    <a href="{{ url('/recetas') }}" class="nav_menu {{ request()->is('recetas') ? 'active' : '' }}">Recetas y Recomendaciones</a>
                </nav>
            </div>

        {{-- iconos de seguridad --}}
        <br>

        <div class="flex flex-wrap md:flex-nowrap justify-center items-center">
            <img src="{{ asset('img/securePayment.png') }}" class="text-center w-[10%] m-5" alt="Pago seguro">
            <img src="{{ asset('img/payment.png') }}" class="text-center w-[10%] m-5" alt="Modo de pago que elijas">
            <img src="{{ asset('img/send.png') }}" class="text-center w-[10%] m-5" alt="Envios confiables">
            <img src="{{ asset('img/segureProduct.png') }}" class="text-center w-[10%] m-5" alt="Productos seguros">
        </div>
        <p class="text-center text-xs sm:text-sm md:text-base">Pagos Seguros | Modo de pago que elijas | Envios a todo el país | Productos Seguros</p><br>
        {{-- fin iconos de seguridad --}}

    </div>
    <footer class="w-full bg-greenG text-center">
        <div class="container pt-5 mx-auto">
            <div class="flex flex-wrap md:flex-nowrap justify-center w-full">
                <div class="">
                    <div class="p-1 rounded-full m-2">
                        <div class="w-32 h-32">
                            <img src="{{ asset('img/logoWhite.svg') }}" class="w-full h-full" alt="logo">
                        </div>
                    </div>
                </div>
                <div class="w-full text-white text-center p-1">
                    <h3 class="text-base font-bold">Información</h3><br>
                    <a href="{{ url('/') }}" class="text-xs hover:text-greenY">Inicio</a><br>
                    <a href="{{ url('/productos') }}" class="text-xs hover:text-greenY">Nuestros Productos</a><br>
                    <a href="{{ url('/nosotros') }}" class="text-xs hover:text-greenY">¿Quienes somos?</a><br>
                    <a href="{{ url('/recetas') }}" class="text-xs hover:text-greenY">Recetas y Recomendaciones</a>
                </div>
                <div class="w-full text-white text-center p-2 m-2">
                    <h3 class="text-base font-bold">Políticas</h3>
                    <a href="#" class="text-xs hover:text-greenY">Políticas de Cookies</a><br>
                    <a href="#" class="text-xs hover:text-greenY">Política de Privacidad</a><br>
                    <a href="#" class="text-xs hover:text-greenY">Política de Devoluciones</a><br>
                    <a href="#" class="text-xs hover:text-greenY">Política de Términos y Condiciones</a><br>
                    <a href="#" class="text-xs hover:text-greenY">Preguntas Frecuentes</a>
                </div>
                <div class="w-full text-white text-center p-2 m-2">
                    <h3 class="text-base font-bold">Siguenos</h3><br>
                    <a href="https://api.whatsapp.com/send?phone=573204195115" target="_blank"><i class='bx bxl-whatsapp hover:text-greenY m-2 text-[30px]'></i></a>
                    <a href="https://es-la.facebook.com/" target="_blank"><i class='bx bxl-facebook-circle hover:text-greenY m-2 text-[30px]'></i></a>
                    <a href="https://www.youtube.com/" target="_blank"><i class='bx bxl-youtube hover:text-greenY m-2 text-[30px]'></i></a>
                    <a href="https://www.instagram.com/?hl=en" target="_blank"><i class='bx bxl-instagram hover:text-greenY m-2 text-[30px]'></i></a>
                </div>
            </div><br>
            </div>
            
        <p class=" text-white pb-5 text-xs md:text-base">&copy; 2024 Naturaleza Sagrada.SAS. Todos los derechos reservados.</p>
    </footer>

    {{-- livewire Script --}}
    @livewireScripts
</body>