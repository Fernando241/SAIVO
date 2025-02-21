<div class="container w-[80%]">
    @livewire('dynamic-content')
    <br>
    <div class="text-right">
        <a href="{{ route('adminProducts') }}" class="bg-greenG py-2 px-6 hover:bg-greenB text-white rounded-md">Volver</a>
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
        <div class="text-center">
            <button type="button" onclick="openEditModal()" class="bg-greenG py-2 px-8 rounded-md hover:bg-greenB text-white">Editar Producto</button>
        </div>
    </form><br>


{{-- Modal de confirmación --}}
<div id="editConfirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm text-center">
        <h2 class="text-xl font-bold text-green-900 mb-4">¿Seguro que quieres actualizar este producto?</h2>
        <p class="text-gray-700 mb-4">Revisa bien los cambios antes de continuar.</p>
        <div class="flex justify-center gap-4">
            <button id="cancelEditBtn" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</button>
            <button id="confirmEditBtn" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-600">Actualizar</button>
        </div>
    </div>
</div>

<script>
    function openEditModal() {
        document.getElementById('editConfirmModal').classList.remove('hidden');
    }
    document.getElementById('cancelEditBtn').addEventListener('click', function() {
        document.getElementById('editConfirmModal').classList.add('hidden');
    });
    document.getElementById('confirmEditBtn').addEventListener('click', function() {
        document.getElementById('solicitudForm').submit();
    });
</script>

</div>