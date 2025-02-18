<div>
    <nav id="menu">
        <a href="#" wire:click.prevent="switchTab('inicio')" class="bg-greenB rounded-lg nav_menu {{ $currentTab === 'inicio' ? 'active' : '' }}">Resumen del Negocio</a>
        <a href="#" wire:click.prevent="switchTab('pedidos')" class="bg-greenB rounded-lg nav_menu {{ $currentTab == 'pedidos' ? 'active' : '' }}">Pedidos</a>
        <a href="#" wire:click.prevent="switchTab('productos')" class="bg-greenB rounded-lg nav_menu {{ $currentTab == 'productos' ? 'active' : '' }}">Productos</a>
        <a href="#" wire:click.prevent="switchTab('clientes')" class="bg-greenB rounded-lg nav_menu {{ $currentTab == 'clientes' ? 'active' : '' }}">Clientes</a>
        <a href="#" wire:click.prevent="switchTab('contabilidad')" class="bg-greenB rounded-lg nav_menu {{ $currentTab == 'contabilidad'? 'active' : '' }}">Contabilidad</a>
        <a href="#" wire:click.prevent="switchTab('usuarios')" class="bg-greenB rounded-lg nav_menu {{ $currentTab == 'usuarios'? 'active' : '' }}">Usuarios</a>
        <a href="#" wire:click.prevent="switchTab('dashboardCliente')" class="bg-greenB rounded-lg nav_menu {{ $currentTab == 'dashboardCliente'? 'active' : '' }}">Mis datos</a>
    </nav><br>

    @if ($currentTab === 'inicio')
        @livewire('admin-dashboard')
    @elseif ($currentTab === 'pedidos')
        @livewire('pedido-manager')
    @elseif ($currentTab === 'productos')
        <h1>Administración de Productos</h1>
    @elseif ($currentTab === 'clientes')
        <h1>Clientes</h1>
        <p>Contenido de la pestaña clientes</p>
    @elseif ($currentTab === 'contabilidad')
        <h1>Contabilidad</h1>
        <p>Esta pagina me va a mostrar cuanto se ha recolectado de iva</p>
    @elseif ($currentTab === 'dashboardCliente')
        <h1>Dashboard del Cliente</h1>
        <p>Contenido de la pestaña dashboard del cliente</p>
    @elseif ($currentTab === 'usuarios')
        <h1>Administración de Usuarios</h1>
        @livewire('users-index')
    @endif
</div>
