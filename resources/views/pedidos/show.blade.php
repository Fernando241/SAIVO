<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Naturaleza Sagrada') }}
        </h2>
    </x-slot>
    @livewire('dynamic-content')
    <div class="content">
        <br>
        <div class="container w-[80%] bg-green-200 p-4 rounded-md">
            <h1>Detalle del Pedido N°: {{ $pedido->id }}</h1>
            <p><b>Fecha de Pedido:</b> {{ $pedido->created_at->format('d/m/Y') }}</p>
            <p><b>Cliente:</b> {{ $pedido->cliente->nombre }}</p>
            <p><b>Total:</b> ${{ $pedido->total }}</p>
            <p><b>Estado:</b> {{ $pedido->estado }}</p>
            @foreach ($pedido->detalles as $detalle)
                <p><b>Producto:</b> {{ $detalle->producto->nombre }}</p>
                <p><b>Cantidad:</b> {{ $detalle->cantidad }}</p>
                <p><b>Precio:</b> ${{ $detalle->precio }}</p>
            @endforeach
        </div>
    </div>
</x-app-layout>