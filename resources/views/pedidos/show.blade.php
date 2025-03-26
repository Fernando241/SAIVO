<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Naturaleza Sagrada') }}
        </h2>
    </x-slot>
    @livewire('dynamic-content')
    <div class="container">
        
        <br>
        <div class="container w-[80%] bg-green-200 p-4 rounded-md">
            <a href="{{ route('pedidos.index') }}" class="bg-greenG p-2 rounded-xl hover:bg-greenB text-white text-right"></i> Volver a Pedidos</a>
            <h1>Detalle del Pedido N°: {{ $pedido->id }}</h1><br>
            <p class="text-right"><b>Fecha de Pedido:</b> {{ $pedido->created_at->format('d/m/Y') }}</p>
            <p><b>Cliente:</b> {{ $pedido->cliente->nombre }}</p>
            <p><b>Telefono:</b> {{ $pedido->cliente->telefono }}</p>
            <p><b>Dirección de Entrega:</b><br> {{ $pedido->cliente->direccion }}</p>
            <p class="text-center text-green-900"><b>Estado:</b></p><h3 class="bg-white p-2 mb-2 text-center font-bold rounded-lg">{{ $pedido->estado }}</h3>
            
            <table class="table">
                <thead>
                    <tr class="bg-greenG text-white">
                        <th>Cantidad</th>
                        <th>Producto</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedido->detalles as $detalle)
                    <tr class="p-4 hover:border border-slate-500">
                        <td class="text-center">{{ $detalle->cantidad }}</td>
                        <td class="text-center">{{ $detalle->producto->nombre }}</td>
                        <td class="text-center">{{ number_format($detalle->precio, 0,',', '.') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <br>
            @php
                $totalProductos = $pedido->detalles->sum(function ($detalle) {
                return $detalle->cantidad;
                });
            @endphp
            <p>Total Productos : <b>{{ number_format($totalProductos, 0, ',', '.') }}</b> </p>
            <p>Precio Total : <b>$ {{ number_format($pedido->total, 0, ',', '.') }}</b></p>
        </div>
    </div>
</x-app-layout>