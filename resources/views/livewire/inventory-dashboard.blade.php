<div>
    <br>
    <h1 class="text-xl font-bold text-green-800 mb-4">Inventario de Productos</h1>

    <div class="bg-white p-4 shadow-md rounded-lg">
        <table class="w-full border">
            <thead>
                <tr class="bg-greenG text-white">
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Nombre</th>
                    <th class="p-2 border">Hoy</th>
                    <th class="p-2 border">Esta Semana</th>
                    <th class="p-2 border">Este Mes</th>
                    <th class="p-2 border">En Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td class="p-2 border text-center">{{ $producto->id }}</td>
                        <td class="p-2 border">{{ $producto->nombre }}</td>
                        <td class="p-2 border text-center">{{ $producto->ventas_hoy }}</td>
                        <td class="p-2 border text-center">{{ $producto->ventas_semana }}</td>
                        <td class="p-2 border text-center">{{ $producto->ventas_mes }}</td>
                        <td class="p-2 border text-center {{ $producto->stock <= 5 ? 'text-red-600 font-bold' : '' }}">
                            {{ $producto->stock }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
