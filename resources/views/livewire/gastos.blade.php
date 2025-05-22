<div>
    <h1>Gastos</h1><br>

    <div class="container w-[80%]">
        <div class="text-center">
            <input 
            wire:model="search"
            wire:keyup="buscarGastos"
            class="w-[70%] rounded-md"
            placeholder="Ingrese el nombre o descripción del gasto">
        </div><br>

        @if (count($gastos))
            <table>
                <thead>
                    <tr class="bg-greenB text-white">
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Valor</th>
                        <th>Descripción</th>
                        <th>Proveedor</th>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gastos as $item)
                        <tr class="p-4 hover:border border-slate-500">
                            <td class="text-center">{{ $item->id }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y') }}</td>
                            <td class="text-center">$ {{ number_format($item->valor, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $item->descripcion }}</td>
                            <td class="text-center">{{ $item->proveedor->nombre }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h2><b>No har registros</b></h2>
        @endif
    </div>
    
</div>
