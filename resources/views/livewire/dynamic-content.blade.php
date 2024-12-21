<div>
    <nav id="menu">
        <a href="#" wire:click.prevent="switchTab('inicio')" class="nav_menu {{ $currentTab === 'inicio' ? 'active' : '' }}">Inicio</a>
        <a href="#" wire:click.prevent="switchTab('inventario')" class="nav_menu {{ $currentTab == 'inventario' ? 'active' : '' }}">Inventario</a>
        <a href="#" wire:click.prevent="switchTab('productos')" class="nav_menu {{ $currentTab == 'productos' ? 'active' : '' }}">Productos</a>
        <a href="#" wire:click.prevent="switchTab('contabilidad')" class="nav_menu {{ $currentTab == 'contabilidad' ? 'active' : '' }}">Contabilidad</a>
    </nav><br>

    @if ($currentTab === 'inicio')
        <h1>Inicio</h1>
        <p>Contenido de la pestaña inicio</p>
    @elseif ($currentTab === 'inventario')
        <h1>Inventario</h1>
        <p>Contenido de la pestaña inventario</p>
    @elseif ($currentTab === 'productos')
        <h1>Productos</h1>
        <p>Contenido de la pestaña productos</p>
    @elseif ($currentTab === 'contabilidad')
        <h1>Contabilidad</h1>
        <p>Contenido de la pestaña contabilidad</p>
    @endif
</div>
