<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Naturaleza Sagrada') }}
        </h2>
    </x-slot>
    @livewire('dynamic-content')
    <br>
    <div class="fixed right-6">
        <a href="{{ route('clientes.index') }}" class="bg-greenG text-white hover:bg-greenB p-2 rounded-md">Volver</a>
    </div>
    <div class="container w-[80%] sm:w-[60%] p-4">
        <div class="bg-green-200 p-4 rounded-xl">
            <h2 class="text-center font-bold">Detalles del Cliente</h2><br>
            <p><b>Nombre:</b></p>
            <p>{{ $cliente->nombre }}</p><br>
            <p><b>Teléfono:</b></p>
            <p>{{ $cliente->telefono }}</p><br>
            <p><b>Domicilio:</b></p>
            <p>{{ $cliente->direccion }}</p><br>
            <p><b>Correo:</b></p>
            <p>{{ $cliente->email }}</p><br>
            <p><b>Pedidos realizados:</b></p>
            <table>
                <thead>
                    <tr class="bg-greenB text-white">
                        <th>Fecha</th>
                        <th>Productos</th>
                        <th>Valor</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $pedido)
                        <tr class="p-4 hover:border border-slate-500">
                            <td class="text-center pt-6">{{ $pedido->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                @php
                                    $totalProductos = $pedido->detalles->sum(function ($detalle) {
                                        return $detalle->cantidad;
                                    });
                                    echo number_format($totalProductos, 0, ',', '.');
                                @endphp
                            </td class="text-center">
                            <td class="text-center">$ {{ number_format($pedido->total, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('pedidos.show', $pedido->id) }}" class="bg-greenG p-2 rounded-md text-white hover:bg-greenY hover:text-greenG">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table><br>
            <p class="text-gray-500 text-center">Aquí se muestran todos los pedidos realizado, fecha, productos, valor</p>
        </div>
        
    </div>
</x-app-layout>