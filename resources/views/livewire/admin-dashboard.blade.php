<div>
    <h1 class="text-xl font-bold text-green-800 mb-4">📊 Resumen del Negocio</h1>

    <div class="grid grid-cols-3 gap-4">
        <div class="p-4 bg-white shadow-md rounded-lg">
            <h2 class="text-lg font-semibold">Ventas</h2>
            <p>Hoy: <strong>{{ $ventas['diarias'] }}</strong></p>
            <p>Esta Semana: <strong>{{ $ventas['semanales'] }}</strong></p>
            <p>Este Mes: <strong>{{ $ventas['mensuales'] }}</strong></p>
        </div>

        <div class="p-4 bg-white shadow-md rounded-lg">
            <h2 class="text-lg font-semibold">Pedidos</h2>
            <p>Completados: <strong>{{ $pedidos['completados'] }}</strong></p>
            <p>Cancelados: <strong>{{ $pedidos['cancelados'] }}</strong></p>
        </div>

        <div class="p-4 bg-white shadow-md rounded-lg">
            <h2 class="text-lg font-semibold">Clientes Nuevos</h2>
            <p><strong>{{ $clientes }}</strong> registrados este mes</p>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 mt-6">
        <div class="bg-white p-4 shadow-md rounded-lg">
            <h2 class="text-lg font-semibold">📈 Ventas (Diarias, Semanales, Mensuales)</h2>
            <canvas id="ventasChart"></canvas>
        </div>

        <div class="bg-white p-4 shadow-md rounded-lg">
            <h2 class="text-lg font-semibold">🥧 Pedidos Completados vs Cancelados</h2>
            <canvas id="pedidosChart"></canvas>
        </div>
    </div>

    <div class="bg-white p-4 shadow-md rounded-lg mt-6">
        <h2 class="text-lg font-semibold">🛒 Productos más vendidos</h2>
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
                    labels: ['Completados', 'Cancelados'],
                    datasets: [{
                        data: [{{ $pedidos['completados'] }}, {{ $pedidos['cancelados'] }}],
                        backgroundColor: ['blue', 'red']
                    }]
                }
            });
        });
    </script>
</div>

