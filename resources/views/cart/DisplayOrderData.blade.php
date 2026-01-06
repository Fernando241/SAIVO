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
                            <td class="border p-2 text-center">COP {{ number_format($producto['price']) }}</td>
                            <td class="border p-2 text-center">COP {{ number_format($producto['quantity'] * $producto['price']) }}</td>
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
            {{-- Precio subtotal temporal --}}
            <p class="text-right"><b>Subtotal:</b> COP {{ number_format($total) }}</p>
            <p class="text-right"><b>Impuesto IVA (19%):</b> No Aplicable</p>
            <p class="text-lg font-bold text-right"><b>Total del Pedido:</b> COP {{ number_format($total) }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 my-4">
            <p class="text-gray-600 text-sm text-center">
                <strong>Nota Legal:</strong> Naturaleza Sagrada S.A.S BIC, identificada con NIT {{ $cliente->nit ?? '902.017.015-7' }}, 
                informa que opera bajo la calidad de <strong>No Responsable de IVA</strong>. 
                En cumplimiento de la normativa vigente, el precio facturado representa el valor total y final de la operación.
            </p>
        </div>

        {{-- Boton temporal para desviar pagos --}}
        <div class="mt-6 text-center">
            <button 
                id="btnCrearPedido"
                class="bg-green-700 text-white px-6 py-2 rounded-lg shadow hover:bg-green-800 transition">
                Continuar al Pago
            </button>
        </div>
        


        {{-- Temporal para crear pedido --}}
        <script>
            document.getElementById('btnCrearPedido').addEventListener('click', function () {
                const btn = this;
                btn.disabled = true; // Deshabilitar para evitar duplicados
                btn.innerText = "Procesando..."; // Feedback visual
                btn.classList.add('opacity-50', 'cursor-not-allowed');

                fetch("{{ route('cart.crearPedido') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = "{{ route('cart.pagosTemporales') }}";
                    } else {
                        alert("No se pudo crear el pedido.");
                    }
                })
                .catch(err => {
                    console.log(err);
                    alert("Ocurrió un error.");
                });

            });
        </script>
    </div>
@endsection