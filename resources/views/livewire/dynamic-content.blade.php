<div x-data="{ open: false }" class="bg-greenB py-1">
    <!-- Menú de navegación -->
    <nav id="menu" :class="open ? 'flex' : 'hidden'" class="flex-col md:flex-row md:flex md:justify-center items-center w-full mt-2 md:mt-0">
        @can('adminDashboard')
        <a href="{{ route('adminDashboard') }}" class="nav_menu {{ $currentRoute == 'adminDashboard' ? 'active' : '' }}">Acerca del Negocio</a>
        @endcan
        @can('users.index')
            <a href="{{ route('users.index') }}" class="nav_menu {{ in_array($currentRoute, ['users.index', 'users.edit']) ? 'active' : '' }}">Usuarios</a>
        @endcan
        @can('pedidos.index')
        <a href="{{ route('pedidos.index') }}" class="nav_menu {{ $currentRoute == 'pedidos.index' ? 'active' : '' }}">Pedidos</a>
        @endcan
        @can('adminProducts')
        <a href="{{ route('adminProducts') }}" class="nav_menu {{ in_array($currentRoute, ['adminProducts', 'productos.edit']) ? 'active' : '' }}">Productos</a>
        @endcan
        @can('inventario')
            <a href="{{ route('inventario') }}" class="nav_menu {{ $currentRoute == 'inventario' ? 'active' : '' }}">Inventario</a>
        @endcan
        @can('clientes.index')
            <a href="{{ route('clientes.index') }}" class="nav_menu {{ in_array($currentRoute, ['clientes.index', 'clientes.show']) ? 'active' : '' }}">Clientes</a>
        @endcan
        @can('contabilidad')
        <a href="#" class="nav_menu {{ $currentRoute == 'contabilidad' ? 'active' : '' }}">Contabilidad</a>
        @endcan
        <a href="#" class="nav_menu {{ $currentRoute == 'dashboardCliente' ? 'active' : '' }}">Mis Datos y pedidos</a>
    </nav>
</div>