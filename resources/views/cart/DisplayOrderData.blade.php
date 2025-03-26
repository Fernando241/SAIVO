@extends('template.template')

@section('title', 'Verificar Pedido')

@section('content')
    <br>
    <div class="container w-[90%] sm:w-[80%] md:w-[70] lg:w-[60%] bg-white p-8 rounded-xl shadow-md">
        <h1 class="text-xl font-bold mb-4">Finalizar Compra<br>Paso 2: Resumen del Pedido</h1>

        {{-- Datos del Cliente --}}
        <h4 class="text-lg font-semibold text-center">Datos del Cliente:</h4>
        <div class="container w-[80%]">
            <p><b>Nombre:</b> {{ $cliente->nombre }}</p>
            <p><b>Teléfono:</b> {{ $cliente->telefono }}</p>
            <p><b>Domicilio:</b> {{ $cliente->direccion }}</p>
        </div>

        <hr class="my-4">

        {{-- Datos del Pedido --}}
        <h4 class="text-lg font-semibold">Datos del Pedido:</h4>
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Producto</th>
                    <th class="border p-2">Cantidad</th>
                    <th class="border p-2">Valor Unidad</th>
                    <th class="border p-2">Valor Total</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($cart))
                    @foreach($cart as $producto)
                        <tr>
                            <td class="border p-2">{{ $producto['name'] }}</td>
                            <td class="border p-2 text-center">{{ $producto['quantity'] }}</td>
                            <td class="border p-2 text-center">$ {{ number_format($producto['price']) }}</td>
                            <td class="border p-2 text-center">$ {{ number_format($producto['quantity'] * $producto['price']) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center p-4 text-red-500">No hay productos en el carrito</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <hr class="my-4">

        {{-- Datos del Costo --}}
        <h4 class="text-lg font-semibold text-center">Datos del Costo:</h4>
        @php
            $subtotal = $total / 1.19;  // Valor sin IVA
            $iva = $total - $subtotal; // 19% del total
        @endphp
        <div class="w-[80%] container">
            <p class="text-right"><b>Subtotal:</b> $ {{ number_format($subtotal, 2) }}</p>
            <p class="text-right"><b>IVA (19%):</b> $ {{ number_format($iva, 2) }}</p>
            <p class="text-lg font-bold text-right"><b>Total del Pedido:</b> $ {{ number_format($total) }}</p>
        </div>

        {{-- Boton para pagos por PayPal --}}
        <div id="paypal-button-container"></div>

        <script>
            var cliente = {!! json_encode($cliente) !!}; // Pasar los datos del cliente a JavaScript
            var cart = {!! json_encode($cart) !!}; //pasar datos del carrito a javascript.
            var total = {!! json_encode($total) !!}; //pasar total a javascript.
            paypal.Buttons({
                style: {
                    shape: 'pill',
                    color: 'blue',
                    label: 'pay',
                },
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: total
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    actions.order.capture().then(function(detalles) {
                        fetch('/procesar-pedido', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                cliente: cliente,
                                cart: cart,
                                total: total,
                                detalles: detalles
                            })
                        })
                        .then(response => {
                            if (response.ok) {
                                    window.location.href = "{{ route('productos.index') }}";
                                    alert('Pago y pedido realizado con Éxito!')
                            } else {
                                alert('Hubo un error al procesar el pedido.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Hubo un error al procesar el pedido.');
                        });
                    });
                },
                onCancel: function(data) {
                    alert("pago cancelado");
                    console.log(data);
                }
            }).render('#paypal-button-container');
        </script>
    </div>
@endsection