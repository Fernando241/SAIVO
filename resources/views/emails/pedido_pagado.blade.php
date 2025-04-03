<!DOCTYPE html>
<html>
<head>
    <title>Su compra ha sido satisfactoria!</title>
</head>
<body>
    <h5>En Naturaleza Sagrada S.A.S. nos complace informarle que:</h5>
    <h1>Su compra ha sido satisfactoria!</h1>
    <p>Gracias por confiar en nosotros. <br>le enviaremos su pedido lo más pronto posible</p>

    <h2>Detalles del pedido:</h2>
    <p>Nombre: {{ $cliente->nombre }}</p>
    <p>Teléfono: {{ $cliente->telefono }}</p>
    <p>Dirección: {{ $cliente->direccion }}</p>
    <p>Fecha: {{ $pedido->created_at }}</p>

    <h2>Productos:</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Valor Unitario</th>
                <th>Valor Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedido->detalles as $detalle)
                <tr>
                    <td class="text-center">{{ $detalle->producto->nombre }}</td>
                    <td class="text-center">{{ $detalle->cantidad }}</td>
                    <td class="text-center">${{ number_format($detalle->precio, 2) }}</td>
                    <td class="text-center">${{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Total: ${{ number_format($pedido->total, 2) }}</p>
</body>
</html>