<div x-data="{ open: false }" class="bg-greenB p-2">
    <!-- Menú de navegación -->
    <nav id="menu" :class="open ? 'flex' : 'hidden'" class="flex-col md:flex-row md:flex md:justify-center items-center w-full mt-2 md:mt-0">
        <a href="{{ route('adminDashboard') }}" class="nav_menu {{ $currentRoute == 'adminDashboard' ? 'active' : '' }}">Promedios</a> 
        <a href="{{ route('pedidos.index') }}" class="nav_menu {{ $currentRoute == 'pedidos.index' ? 'active' : '' }}">Pedidos</a>
        <a href="{{ route('adminProducts') }}" class="nav_menu {{ $currentRoute == 'adminProducts' ? 'active' : '' }}">Productos</a>
        <a href="{{ route('clientes.index') }}" class="nav_menu {{ $currentRoute == 'clientes.index' ? 'active' : '' }}">Clientes</a>
        <a href="#" class="nav_menu {{ $currentRoute == 'contabilidad' ? 'active' : '' }}">Contabilidad</a>
        <a href="{{ route('users.index') }}" class="nav_menu {{ $currentRoute == 'users.index' ? 'active' : '' }}">Usuarios</a>
        <a href="#" class="nav_menu {{ $currentRoute == 'dashboardCliente' ? 'active' : '' }}">Mis Datos</a>
    </nav>
</div>

