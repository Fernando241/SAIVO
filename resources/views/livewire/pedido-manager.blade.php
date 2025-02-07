<div>
    <h1>🛒 Gestión de Pedidos</h1>

    <select wire:model="filtroEstado" class="mb-4 p-2 border rounded">
        <option value="">Todos</option>
        <option value="pendiente">Pendiente</option>
        <option value="enviado">Enviado</option>
        <option value="entregado">Entregado</option>
    </select>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Cliente</th>
                <th class="p-2 border">Total</th>
                <th class="p-2 border">Estado</th>
                <th class="p-2 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
                <tr class="bg-white">
                    <td class="p-2 border">{{ $pedido->cliente }}</td>
                    <td class="p-2 border">${{ number_format($pedido->total, 2) }}</td>
                    <td class="p-2 border">{{ ucfirst($pedido->estado) }}</td>
                    <td class="p-2 border">
                        <button wire:click="cambiarEstado({{ $pedido->id }}, 'pendiente')"
                                class="p-1 {{ $pedido->estado === 'pendiente' ? 'bg-gray-400' : 'bg-yellow-500' }} text-white rounded">
                            Pendiente
                        </button>
                        <button wire:click="cambiarEstado({{ $pedido->id }}, 'enviado')"
                                class="p-1 {{ $pedido->estado === 'enviado' ? 'bg-gray-400' : 'bg-blue-500' }} text-white rounded">
                            Enviado
                        </button>
                        <button wire:click="cambiarEstado({{ $pedido->id }}, 'entregado')"
                                class="p-1 {{ $pedido->estado === 'entregado' ? 'bg-gray-400' : 'bg-green-500' }} text-white rounded">
                            Entregado
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $pedidos->links() }}
</div>

