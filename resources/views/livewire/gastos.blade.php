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
            <table class="table">
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
                            <td class="text-center p-2">{{ $item->id }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y') }}</td>
                            <td class="text-center">$ {{ number_format($item->valor, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $item->descripcion }}</td>
                            <td class="text-center">{{ $item->proveedor->nombre }}</td>
                            <td class="text-center">
                                <a href="{{ route('gastos.edit', $item->id) }}" class="bg-greenG p-2 rounded-md text-white hover:bg-greenB">Editar</a>
                                <form id="" action="" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="" class="text-white bg-red-500 p-2 hover:bg-red-400 rounded-md">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <div class="flex justify-center">
                <a href="{{ route('gastos.create') }}" class="inline-block px-8 py-3 text-sm font-medium text-white bg-greenG hover:bg-greenB rounded-md">Agregar nuevo gasto</a>
            </div>
        @else
            <h2><b>No hay registros</b></h2>
        @endif
    </div>
    
</div>
