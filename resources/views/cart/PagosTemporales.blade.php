@extends('template.template')

@section('title', 'Pagos Temporales')

@section('content')
    <div class="container w-[90%] sm:w-[80%] md:w-[70] lg:w-[60%] bg-white p-8 rounded-xl shadow-md text-center">
        <h1 class="text-2xl font-bold mb-4 text-green-700">🌿 Naturaleza Sagrada</h1>
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Métodos de Pago Temporales</h2>

        <p class="text-gray-600 mb-4 leading-relaxed">
            Estimado <strong>{{ $cliente->nombre ?? 'cliente' }}</strong>, 
            es un gusto informarte que tu pedido fue generado correctamente,<br>encontraras los detalles en la bandeja de entrada de tu correo electrónico<br>
            {{-- Tambien queremos contarte que actualmente estamos actualizando nuestros sistemas de pago para ofrecerte una experiencia más segura y confiable. --}}
        </p>

        <p class="text-gray-700 mb-4 px-4">
            Actualmente el estado de tu pedido es: <br><b>ESPERANDO CONFIRMACIÓN DE PAGO</b> <br>puedes cambiarlo a: <br><b>PAGO CONFIRMADO - PENDIENTE DE ENVIO</b> <br>
            consignando por los siguientes medios:
        </p>

        <div class="bg-green-50 border border-green-300 rounded-lg p-4 mb-6 text-left">
            <p class="font-semibold text-green-800 mb-2">💰 Transferencia segura por:</p>
            <ul class="list-disc list-inside text-gray-700">
                <li><strong>Nequi:</strong> 320 419 5115</li>
                <li><strong>Daviplata:</strong> 320 419 5115</li>
                <li><strong>Cuenta Bancaria:</strong> Banco de Bogotá - Ahorros 123 643 058</li>
                <p>Cualquiera de las cuentas esta a nombre de Luis Fernando Rolón</p>
            </ul>
        </div>

        <p class="text-gray-600 mb-4">
            Una vez realices el pago, por favor envíanos el comprobante al correo: <br>
            <a href="mailto:pedidos@naturalezasagradasas.com" class="text-green-600 font-semibold underline">
                pedidos@naturalezasagradasas.com
            </a><br>
            o al WhatsApp: <b class="text-greenG">320 4195115</b>
        </p>

        <p class="text-gray-500 italic mb-6">
            <b>Por favor, Incluye: </b> <br>- capture del pago <br>- tu nombre completo <br><br>con estos datos garantizamos el despacho correcto de su pedido.
        </p>

        <div class="border-t border-gray-300 my-4"></div>

        <h3 class="text-lg font-semibold mb-2 text-gray-700">Resumen del Pedido</h3>

        <table class="table-auto w-full border-collapse border border-gray-300 mb-4 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Producto</th>
                    <th class="border p-2">Cantidad</th>
                    <th class="border p-2">Valor Unidad</th>
                    <th class="border p-2">Total</th>
                </tr>
            </thead>
            <tbody>
            {{--     @foreach($cart as $producto)
                    <tr>
                        <td class="border p-2">{{ $producto['name'] }}</td>
                        <td class="border p-2 text-center">{{ $producto['quantity'] }}</td>
                        <td class="border p-2 text-center">COP {{ number_format($producto['price']) }}</td>
                        <td class="border p-2 text-center">COP {{ number_format($producto['quantity'] * $producto['price']) }}</td>
                    </tr>
                @endforeach --}}
                @foreach($cart as $item)
                    <tr>
                        <td>{{ $item->producto->nombre }}</td>
                        <td class="text-center">{{ $item->cantidad }}</td>
                        <td class="text-center">COP {{ number_format($item->precio) }}</td>
                        <td class="text-center">COP {{ number_format($item->precio * $item->cantidad) }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <p class="text-right font-semibold text-gray-700 mb-2">Total del Pedido: 
            <span class="text-green-700">COP {{ number_format($total) }}</span>
        </p>
        <br>

        <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center text-gray-700 leading-relaxed">
            <b>Nota importante:</b><br> <b class="text-greenG">el  domicilio es gratis!.</b><br><br>
            En <b>Naturaleza Sagrada S.A.S.</b><br>queremos que tu experiencia sea clara, humana y sin sorpresas<br> 
            desde nuestras fórmulas hasta la entrega en tus manos.
        </div>

        <div class="mt-6">
            <a href="{{ route('productos.index') }}" 
                class="bg-green-700 text-white px-6 py-2 rounded-lg shadow hover:bg-green-800 transition">
                Volver a la Tienda
            </a>
        </div>
    </div>
@endsection
