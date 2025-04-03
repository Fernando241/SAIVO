<div>
    <br>
    <h1 class="text-xl font-bold text-green-800 mb-4"> Resumen del Negocio</h1>

    <div class="grid grid-cols-3 gap-4">
        <div class="p-4 bg-white shadow-md rounded-lg">
            <h2 class="text-lg font-semibold text-center text-green-900">Ventas</h2>
            <div class="flex flex-row">
                <p class="basis-1/3">Today: </p>
                <p class="basis-2/3 text-right"><b>{{ number_format($ventas['diarias'], 0, ',', '.') }}</b></p>
            </div>
            <div class="flex flex-row">
                <p class="basis-1/3">Week: </p>
                <p class="basis-2/3 text-right"><b>{{ number_format($ventas['semanales'], 0, ',', '.') }}</b></p>
            </div>
            <div class="flex flex-row">
                <p class="basis-1/3">Month: </p>
                <p class="basis-2/3 text-right"><b>{{ number_format($ventas['mensuales'], 0, ',', '.') }}</b></p>
            </div>
        </div>

        <div class="p-4 bg-white shadow-md rounded-lg">
            <h2 class="text-lg font-semibold text-center text-green-900">Pedidos</h2>
            <div class="flex flex-row">
                <p class="basis-1/3">Pendientes: </p>
                <p class="basis-2/3 text-right"><b>{{ $pedidos['pendientes'] }}</b></p>
            </div>
            <div class="flex flex-row">
                <p class="basis-1/3">Enviados: </p>
                <p class="basis-2/3 text-right"><b>{{ $pedidos['enviados'] }}</b></p>
            </div>
            <div class="flex flex-row">
                <p class="basis-1/3">Entregados: </p>
                <p class="basis-2/3 text-right"><b>{{ $pedidos['entregados'] }}</b></p>
            </div>
        </div>

        <div class="p-4 bg-white shadow-md rounded-lg">
            <h2 class="text-lg font-semibold text-center text-green-900">Clientes Nuevos</h2>
            <div class="text-center">
                <br>
                <p><strong>{{ $clientes }}</strong> registrados este mes</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 mt-6">
        <div class="bg-white p-4 shadow-md rounded-lg">
            <h2 class="text-lg font-semibold text-center text-green-900"> Ventas (Diarias, Semanales, Mensuales)</h2>
            <canvas id="ventasChart"></canvas>
        </div>

        <div class="bg-white p-4 shadow-md rounded-lg">
            <h2 class="text-lg font-semibold text-center text-green-900"> Balance estado de pedidos</h2>
            <canvas id="pedidosChart"></canvas>
        </div>
    </div>

    <div class="bg-white p-4 shadow-md rounded-lg mt-6">
        <h2 class="text-lg font-semibold text-center text-green-900"> Productos más vendidos</h2>
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">Producto</th>
                    <th class="p-2 border">Ventas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td class="p-2 border">{{ $producto['nombre'] }}</td>
                        <td class="p-2 border">{{ $producto['ventas'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ventasCtx = document.getElementById('ventasChart').getContext('2d');
            new Chart(ventasCtx, {
                type: 'line',
                data: {
                    labels: ['Hoy', 'Esta Semana', 'Este Mes'],
                    datasets: [{
                        label: 'Ventas',
                        data: [{{ $ventas['diarias'] }}, {{ $ventas['semanales'] }}, {{ $ventas['mensuales'] }}],
                        borderColor: 'green',
                        fill: false
                    }]
                }
            });

            const pedidosCtx = document.getElementById('pedidosChart').getContext('2d');
            new Chart(pedidosCtx, {
                type: 'pie',
                data: {
                    labels: ['Pendientes', 'Enviados', 'Entregados'],
                    datasets: [{
                        data: [{{ $pedidos['pendientes'] }}, {{ $pedidos['enviados'] }}, {{ $pedidos['entregados'] }}],
                        backgroundColor: ['red', 'blue', 'green']
                    }]
                }
            });
        });
    </script>
</div>