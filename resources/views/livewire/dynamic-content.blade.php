<div x-data="{ open: false }" class="bg-greenB py-1">
    <!-- Botón del Menú Hamburguesa (Visible solo en pantallas menores a lg) -->
    <button @click="open = !open" class="xl:hidden p-2 text-white">
        ☰ Menú
    </button>

    <!-- Menú de navegación -->
    <nav :class="open ? 'flex' : 'hidden'" class="flex-col xl:flex-row xl:flex xl:justify-center items-center w-full mt-2 xl:mt-0 xl:flex xl:relative xl:left-0 xl:w-auto">
        @can('adminDashboard')
        <a href="{{ route('adminDashboard') }}" class="nav_menu {{ $currentRoute == 'adminDashboard' ? 'active' : '' }}">% Negocio</a>
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
        {{-- compras --}}
        <a href="{{ route('compras.index') }}" class="nav_menu {{ in_array($currentRoute, ['compras.index', 'compras.show', 'compras.edit']) ? 'active' : '' }}">Compras</a>
        {{-- proveedores --}}
        <a href="{{ route('proveedores.index') }}" class="nav_menu {{ in_array($currentRoute, ['proveedores.index', 'proveedores.show', 'proveedores.edit']) ? 'active' : '' }}">Proveedores</a>
        <a href="#" class="nav_menu {{ $currentRoute == 'dashboardCliente' ? 'active' : '' }}">Mis datos</a>
    </nav>
</div>

