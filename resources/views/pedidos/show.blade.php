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
            {{-- El siguiente boton simula con javascript la funcion de la tecla atras del navegador --}}
            <button onclick="goBack()" class="bg-greenG p-2 rounded-xl hover:bg-greenB text-white text-right"></i>Volver</button>
            <h1>Detalle del Pedido N°: {{ $pedido->id }}</h1><br>
            <p class="text-right"><b>Fecha de Pedido:</b> {{ $pedido->created_at->format('d/m/Y') }}</p>
            <p><b>Cliente:</b> {{ $pedido->cliente->nombre }}</p>
            <p><b>Telefono:</b> {{ $pedido->cliente->telefono }}</p>
            <p><b>Dirección de Entrega:</b><br> {{ $pedido->cliente->direccion }}</p>
            <p class="text-center text-green-900"><b>Estado:</b></p>
            <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST" id="estadoForm">
                @csrf
                @method('PUT')
                <select name="estado" class="bg-white p-2 mb-2 text-center font-bold rounded-lg w-full">
                    <option value="Pendiente" {{ $pedido->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="Enviado" {{ $pedido->estado == 'Enviado' ? 'selected' : '' }}>Enviado</option>
                    <option value="Entregado" {{ $pedido->estado == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                </select>
                @can('pedidos.edit')
                    <div class="text-center">
                        <button type="button" onclick="openEstadoModal()" class="bg-greenB p-2 rounded-lg w-full hover:bg-greenY text-white hover:text-greenG">
                            Actualizar Estado
                        </button>
                    </div>
                @endcan
                
            </form>
            <br>
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

    {{-- Modal de confirmación --}}
    <div id="estadoConfirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm text-center">
            <h2 class="text-xl font-bold text-green-900 mb-4">¿Seguro que quieres actualizar el estado del pedido?</h2>
            <p class="text-gray-700 mb-4">Revisa bien los cambios antes de continuar.</p>
            <div class="flex justify-center gap-4">
                <button id="cancelEstadoBtn" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</button>
                <button id="confirmEstadoBtn" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-600">Actualizar</button>
            </div>
        </div>
    </div>

    <script>
        function openEstadoModal() {
            document.getElementById('estadoConfirmModal').classList.remove('hidden');
        }
        document.getElementById('cancelEstadoBtn').addEventListener('click', function() {
            document.getElementById('estadoConfirmModal').classList.add('hidden');
        });
        document.getElementById('confirmEstadoBtn').addEventListener('click', function() {
            document.getElementById('estadoForm').submit();
        });
    </script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</x-app-layout>