<div class="container">
    <h1>Lista de Pedidos</h1>
    <div class="container w-[70%] sm:w-[50%] bg-green-200 rounded-lg p-4">
        <p class="text-sm text-gray-700">
            <b>IMPORTANTE: </b>Para saber si un cliente ha realizado pedidos:<br>
            1. Valla a la pestaña Clientes<br>
            2. En la barra de busqueda coloque el nombre o email del cliente<br>
            3. ahi podra ver el <b>ID del cliente</b><br>
            4. Coloque ese número de <b>ID</b> en la barra de busqueda siguiente
        </p>
    </div><br>
    <div class="text-center">
        <input wire:model="search"
        wire:keyup="buscarPedidos"
        class="w-[80%] rounded-md" 
        placeholder="Ingrese el número ID del cliente">
    </div><br>

    @if (count($pedidos))
    <table class="table">
        <thead>
            <tr class="bg-greenB text-white">
                <th class="hidden md:table-cell">ID Pedido</th>
                <th>ID Cliente</th>
                <th>Cliente</th>
                <th class="hidden md:table-cell">Fecha de Compra</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedido as $item)
                <tr class="p-4 hover:border border-slate-500">
                    <td class="text-center hidden md:table-cell">{{ $item->id }}</td>
                    <td class="text-center p-2">{{ $item->cliente->id }}</td>
                    <td class="text-center">{{ $item->cliente->nombre }}</td>
                    <td class="text-center hidden md:table-cell">{{ $item->created_at->format('d/m/Y') }}</td>
                    <td class="text-center">$ {{ number_format($item->total, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @if ($item->estado == 'Pendiente')
                            <span class="text-red-500">Pendiente</span>
                        @elseif ($item->estado == 'Enviado')
                            <span class="text-blue-500">Enviado</span>
                        @elseif ($item->estado == 'Entregado')
                            <span class="text-green-500">Entregado</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('pedidos.show', $item->id) }}" class="bg-greenG p-2 rounded-md text-white hover:bg-greenB">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h2 class="text-center"><b>Este cliente aun no a realizado pedidos!</b></h2>
    @endif
    <br>
    <div class="bg-greenG w-full h-10"></div>
    <div>{{ $pedido->links() }}</div>
</div>
