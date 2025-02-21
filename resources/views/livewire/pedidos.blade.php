<div>
    <h1>Lista de Pedidos</h1>
    <div class="text-center">
        <input wire:model="search"
        wire:keyup="buscarPedidos"
        class="w-[80%] rounded-md" 
        placeholder="Ingrese el número de pedido o nombre del cliente">
    </div><br>

    @if (count($pedidos))
    <table class="table">
        <thead>
            <tr class="bg-greenB text-white">
                <th>Número de Pedido</th>
                <th>Cliente</th>
                <th>Fecha de Compra</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedido as $item)
                <tr class="p-4 hover:border border-slate-500">
                    <td class="text-center">{{ $item->id }}</td>
                    <td class="text-center">{{ $item->cliente->nombre }}</td>
                    <td class="text-center">{{ $item->created_at->format('d/m/Y') }}</td>
                    <td class="text-center">${{ $item->total }}</td>
                    <td class="text-center">{{ $item->estado }}</td>
                    <td class="text-center">
                        <a href="{{ route('pedidos.show', $item->id) }}" class="btn btn-primary">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h2><b>No hay pedidos registrados</b></h2>
    @endif

    <div>{{ $pedido->links() }}</div>
</div>
