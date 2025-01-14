<div class="container">
            {{-- icono de flecha atras para volver a la dashboard --}}
    <div class="flex justify-end">
        <a href="{{ route('adminProducts') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            Volver
        </a>
    </div>

    <h1>Editar Producto</h1>
            
    <form action="{{ route('productos.update', $product->id)}}" method="POST" enctype="multipart/form-data" id="solicitudForm">
        @csrf
        @method('PUT')
        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $product->nombre }}" />
        </div>
        <div>
            <label for="presentacion" class="block text-sm font-medium text-gray-700">Presentación</label>
            <input type="text" id="presentacion" name="presentacion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $product->presentacion }}" />
        </div>
        <div>
            <label for="componentes" class="block text-sm font-medium text-gray-700">Componentes</label>
            <input type="text" id="componentes" name="componentes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $product->componentes }}" />
        </div>
        <div>
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-32">{{ $product->descripcion }}</textarea>
        </div>
        <div>
            <label for="indicaciones" class="block text-sm font-medium text-gray-700">Indicaciones</label>
            <textarea id="indicaciones" name="indicaciones" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-32">{{ $product->indicaciones }}</textarea>
        </div>
        <div>
            <label for="contraindicaciones" class="block text-sm font-medium text-gray-700">Contraindicaciones</label>
            <textarea id="contraindicaciones" name="contraindicaciones" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-32">{{ $product->contraindicaciones }}</textarea>
        </div>
        <div>
            <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
            <input type="number" id="stock" name="stock" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $product->stock }}" />
        </div>
        <div>
            <label for="precio_compra" class="block text-sm font-medium text-gray-700">Precio de Compra</label>
            <input type="number" id="precio_compra" name="precio_compra" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $product->precio_compra }}" />
        </div>
        <div>
            <label for="precio_venta" class="block text-sm font-medium text-gray-700">Precio de Venta</label>
            <input type="number" id="precio_venta" name="precio_venta" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $product->precio_venta }}" />
        </div>
        <div>
            <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen</label>
            <input type="file" id="imagen" name="imagen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $product->imagen }}" />
        </div><br>
        <div>
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded-md">Editar</button>
        </div>
    </form>
</div>


    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('solicitudForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevenir el envío del formulario

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Publicación actualizada con exito!',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        // Enviar el formulario después de mostrar la alerta
                        event.target.submit();
                    }
                });
            });
    </script>
@stop
</div>