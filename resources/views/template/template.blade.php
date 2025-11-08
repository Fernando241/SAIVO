<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Naturaleza Sagrada | Productos Naturales Artesanales')</title>

    <meta name="description" content="Naturaleza Sagrada | Extracto Sagrado | Limpieza Amazónica | Aceite El Milagroso | Productos naturales artesanales inspirados en la sabiduría indígena. Preparaciones tradicionales para el bienestar integral y la conexión con la naturaleza.">
    <meta name="keywords" content="productos naturales, cosmética artesanal, sabiduría indígena, bienestar natural, equilibrio energético, herbolaria tradicional, artesanía botánica, naturaleza sagrada">
    <meta name="author" content="Naturaleza Sagrada">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <!-- PayPal Script -->
    <script
            src="https://www.paypal.com/sdk/js?client-id=AfANYdWSKkhU-DoNtvtkpCJFwZWHmz612gzSmdcSbR2SpcxJTS9lOEJArmAz_YbsZIDG_7h-HAj4TpLZ"
            data-sdk-integration-source="developer-studio"
        ></script>
    
    {{-- livewire Style --}}
    @livewireStyles
    @stack('meta')
</head>

<body>
    <header>
        {{-- Inicio de sesión --}}
        <div class="bg-greenG text-center h-[90px]">
            <div>  
                @if (Route::has('login'))
                    <nav>
                        @auth
                            <p class="text-greenY font-semibold text-lg mb-2">Bienvenid@, {{ auth()->user()->name }}</p>
                            <a href="{{ url('/dashboard') }}" class="text-greenG p-1 font-semibold bg-greenY rounded-lg hover:bg-greenB hover:text-greenB">🌿 entra a tu rincón sagrado</a>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <button type="submit" 
                                    class="text-white hover:text-greenY hover:font-bold">
                                    {{ __('Cerrar Sesión') }}
                                </button>
                            </form>
                        @else
                        <div class="flex flex-col items-center justify-center">
                            <a href="{{ route('login') }}" class="text-white hover:text-yellow-200 hover:font-bold my-2">Iniciar Sesión</a>
        
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-white hover:text-yellow-200 hover:font-bold">Registrarse</a>
                            @endif
                        </div>
                        @endauth
                    </nav>
                @endif
                
            </div>
        </div>
        {{-- Carrito de compras --}}
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
        <a href="https://www.facebook.com/profile.php?id=61574984795833" id="icono" target="_black"><i class='bx bxl-facebook-circle'></i></a>
        <a href="https://www.youtube.com/" id="icono" target="_black"><i class='bx bxl-youtube'></i></a>
        <a href="https://www.instagram.com/?hl=en" id="icono" target="_black"><i class='bx bxl-instagram'></i></a>
        <a href="https://twitter.com/" id="icono" target="_black"><i class='bx bxl-twitter'></i></a>
    </nav>
    
    {{-- alertas en páginas que heredan de esta plantilla --}}
    @if(session('success')) 
        <div x-data="{ show: true }" 
            x-show="show" 
            x-init="setTimeout(() => show = false, 2000)" 
            class="fixed top-32 md:top-20 right-5 bg-greenB text-white px-4 py-3 rounded-lg shadow-lg">
            <b class="font-bold">¡Éxito!</b>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- logo de la empresa --}}
    <div class="bg-green-300 bg-repeat bg-[url('/img/patronW.svg')]"> 
        <div class="grid place-items-center bg-white bg-repeat bg-[url('/img/patronGB.svg')] pt-16">
            <div class="p-2">
                <img src="{{ asset('img/LogoHorizontalF.svg') }}" alt="logo">
            </div>
        </div>
        
        {{-- Menú de páginas --}}
        <div class="bg-greenB mx-auto relative flex flex-col items-center">
            <div class="w-full flex justify-center md:hidden">
                <button id="menu-button" class="text-white w-full text-center py-4 hover:text-greenY hover:font-bold">Menú</button>
            </div>
            
            <nav id="menu-items" class="hidden md:flex md:flex-row justify-center md:items-center">
                <a href="{{ url('/') }}" class="text-white px-4 py-2 text-center hover:text-greenY hover:font-bold {{ request()->is('/') ? 'bg-greenG' : '' }}">Inicio</a>
                <a href="{{ url('/productos') }}" class="text-white px-4 py-2 text-center hover:text-greenY hover:font-bold {{ request()->is('productos') ? 'bg-greenG' : '' }}">Nuestros Productos</a>
                <a href="{{ url('/nosotros') }}" class="text-white px-4 py-2 text-center hover:text-greenY hover:font-bold {{ request()->is('nosotros') ? 'bg-greenG' : '' }}">¿Quiénes somos?</a>
                <a href="{{ url('/recetas') }}" class="text-white px-4 py-2 text-center hover:text-greenY hover:font-bold {{ request()->is('recetas') ? 'bg-greenG' : '' }}">Recetas y Recomendaciones</a>
            </nav>
        </div>

        {{-- fin Menú de páginas --}}
        <br>
        @yield('content')
        </h2>
        <div class="text-center text-greenB text-sm mt-6">
            <p>#SabiduríaAncestral #ProductosNaturales #BienestarIntegral #CuidadoNatural #NaturalezaSagrada</p>
        </div><br>
        
        <hr>
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
                            <img src="{{ asset('img/isotipoY.svg') }}" class="w-full h-full" alt="logo">
                        </div>
                    </div>
                </div>
                <div class="w-full text-white text-center p-1">
                    <h3 class="text-base font-bold">Información</h3><br>
                    <a href="{{ url('/') }}" class="text-xs hover:text-greenY {{ request()->is('/') ? 'text-greenY' : '' }}">Inicio</a><br>
                    <a href="{{ url('/productos') }}" class="text-xs hover:text-greenY {{ request()->is('productos') ? 'text-greenY' : '' }}">Nuestros Productos</a><br>
                    <a href="{{ url('/nosotros') }}" class="text-xs hover:text-greenY {{ request()->is('nosotros') ? 'text-greenY' : '' }}">¿Quienes somos?</a><br>
                    <a href="{{ url('/recetas') }}" class="text-xs hover:text-greenY {{ request()->is('recetas') ? 'text-greenY' : '' }}">Recetas y Recomendaciones</a>
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
    <script>
        const menuButton = document.getElementById('menu-button');
        const menuItems = document.getElementById('menu-items');
    
        menuButton.addEventListener('click', () => {
            menuItems.classList.toggle('hidden');
            menuItems.classList.toggle('flex');
            menuItems.classList.toggle('flex-col');
            menuItems.classList.toggle('absolute');
            menuItems.classList.toggle('top-full');
            menuItems.classList.toggle('left-0');
            menuItems.classList.toggle('w-full');
            menuItems.classList.toggle('bg-greenB')
            menuItems.classList.toggle('items-center')
        });
    </script>
    
</body>