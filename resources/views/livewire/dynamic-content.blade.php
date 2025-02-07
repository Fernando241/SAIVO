<div>
    <nav id="menu">
        <a href="#" wire:click.prevent="switchTab('inicio')" class="nav_menu {{ $currentTab === 'inicio' ? 'active' : '' }}">Resumen del Negocio</a>
        <a href="#" wire:click.prevent="switchTab('pedidos')" class="nav_menu {{ $currentTab == 'pedidos' ? 'active' : '' }}">Pedidos</a>
        <a href="#" wire:click.prevent="switchTab('productos')" class="nav_menu {{ $currentTab == 'productos' ? 'active' : '' }}">Productos</a>
        <a href="#" wire:click.prevent="switchTab('contabilidad')" class="nav_menu {{ $currentTab == 'contabilidad' ? 'active' : '' }}">Contabilidad</a>
    </nav><br>

    @if ($currentTab === 'inicio')
        @livewire('admin-dashboard')
    @elseif ($currentTab === 'pedidos')
        @livewire('pedido-manager')
    @elseif ($currentTab === 'productos')
        <h1>Administración de Productos</h1>
    @elseif ($currentTab === 'contabilidad')
        <h1>Contabilidad</h1>
        <p>Contenido de la pestaña contabilidad</p>
    @endif
</div>
