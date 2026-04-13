@extends('template.template')

@section('title', 'Pagos Temporales')

@section('content')
    <div class="container w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] bg-white p-8 rounded-2xl shadow-xl text-center mx-auto border border-gray-100">
    
        <h1 class="text-2xl font-bold mb-4 text-greenG">
            ¡Gracias por elegir el bienestar natural,<br> 
            <span class="text-greenB">{{ $cliente->nombre ?? 'querido cliente' }}</span>!
        </h1><br>
        
        <p class="text-gray-600 mb-6 leading-relaxed">
            Nos hace muy felices saber que pronto disfrutarás de nuestros productos. ✨ <br>
            Tus datos de entrega y tu pedido se han generado <strong>correctamente</strong> en nuestro sistema.
        </p>

        <div class="mb-8">
            <p>Estado:</p>
            <span class="bg-orange-100 text-orange-700 px-4 py-2 rounded-full font-bold text-sm tracking-wide uppercase">
                Pendiente de Pago
            </span>
        </div>

        <p class="text-gray-700 mb-6 px-4">
            Para que podamos preparar tu paquete hoy mismo y enviarlo cuanto antes a tu puerta, solo falta un último y pequeño paso: 
            <strong>realizar tu pago a través de nuestra llave segura.</strong>
        </p>

        <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-2xl p-6 mb-8 shadow-sm">
            <p class="font-bold text-green-900 mb-3 flex justify-center items-center gap-2">
                🌿 Información de Pago
            </p>
            <div class="text-gray-800 space-y-2">
                <p class="text-xl"><strong>Llave (Bre-B):</strong> <span class="bg-white px-3 py-1 rounded-md border border-green-300 font-mono text-green-700">0090887342</span></p>
                <p><strong>A nombre de:</strong> <strong class="bg-white px-3 py-1 rounded-md border border-green-300 font-mono text-green-700">Naturaleza Sagrada</strong></p>
            </div>
        </div>

        <div class="mb-10">
            <p class="text-gray-600 mb-6 italic">
                "¡Es muy sencillo! Una vez realices el pago, envíanos el comprobante y tu nombre completo para priorizar tu despacho."
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                @php
                    $mensajeWa = "¡Hola! Soy " . ($cliente->nombre ?? 'cliente') . ", ya realicé mi pedido. ✨ Aquí les paso el capture del comprobante para recibir mi bienestar pronto. 🌿";
                    $urlWa = "https://wa.me/573219729331?text=" . urlencode($mensajeWa);
                @endphp
                
                <a href="{{ $urlWa }}" target="_blank" 
                class="flex items-center justify-center gap-2 bg-greenG text-white px-6 py-3 rounded-xl font-bold hover:bg-greenB transition-all shadow-lg hover:scale-105">
                    <i class="fab fa-whatsapp text-xl"></i> Confirmar por WhatsApp
                </a>

                <a href="mailto:pedidos@naturalezasagradasas.com" 
                class="flex items-center justify-center gap-2 bg-gray-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-greenB transition-all shadow-lg hover:scale-105">
                    Enviar por Correo
                </a>
            </div>
        </div>

        <div class="overflow-hidden rounded-xl border border-gray-200 mb-6">
            <table class="table-auto w-full text-sm">
                <thead class="bg-gray-50 text-gray-700 uppercase font-semibold">
                    <tr>
                        <th class="p-4 text-left">Producto</th>
                        <th class="p-4 text-center">Cantidad</th>
                        <th class="p-4 text-right">Valor</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($cart as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-left font-medium">{{ $item->producto->nombre }}</td>
                            <td class="p-4 text-center">{{ $item->cantidad }}</td>
                            <td class="p-4 text-right">COP {{ number_format($item->precio * $item->cantidad) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="w-[90%] container">
                @php
                    $subtotal = $total / 1.19;
                    $iva = $total - $subtotal;
                @endphp

                <p class="text-right"><b>Subtotal (sin IVA):</b> COP {{ number_format($subtotal) }}</p>
                <p class="text-right"><b>IVA (19%):</b> COP {{ number_format($iva) }}</p>
            </div>
 
            <div class="bg-gray-50 p-4 text-right border-t">
                <p class="text-lg font-bold text-green-800">Total del Pedido: COP {{ number_format($total) }}</p>
                <p class="text-xs text-gray-600 font-semibold uppercase tracking-widest mt-1">¡Tu envío para Bogotá o Cundinamarca<br>es totalmente gratis!</p>
            </div>
        </div>

        <div class="py-8 px-4 bg-gray-50 rounded-2xl mb-8 border border-gray-100 italic text-gray-600">
            <p class="mb-2 font-semibold text-green-800 not-italic">En Naturaleza Sagrada S.A.S. BIC</p>
            <p>
                "Nos apasiona servirte. Estamos listos para que tu experiencia sea humana, transparente y llena de bienestar, desde la creación de nuestras fórmulas hasta que el producto llega a tus manos."
            </p>
        </div>

        <div class="space-y-6">
            <a href="{{ route('productos.index') }}" 
                class="inline-block text-green-700 font-semibold border-b-2 border-green-700 pb-1 hover:text-green-900 transition">
                ← Seguir explorando la tienda
            </a>

            <div class="bg-gray-100 rounded-lg p-5 text-[11px] text-gray-500 leading-relaxed max-w-2xl mx-auto text-justify border-l-4 border-green-600">
                <p>
                    <strong>Nota Legal:</strong> Naturaleza Sagrada S.A.S BIC, identificada con NIT {{ $cliente->nit ?? '902.017.015-7' }}, 
                    es <strong>Responsable del Impuesto sobre las Ventas (IVA)</strong>. 
                    De acuerdo con la normativa vigente, los precios publicados incluyen IVA, el cual se discrimina en el resumen y en la factura electrónica correspondiente.
                </p>
            </div>
        </div>
    </div>
@endsection
