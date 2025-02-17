<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="container">
            {{-- icono de flecha atras para volver a la dashboard --}}
            <div class="flex justify-end">
                <a href="{{ route('adminProducts') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Volver
                </a>
            </div>

            <h1>Nuevo Producto</h1>
            
            <form action="{{ route('productos.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
                </div>
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug (para URLs amigables SEO) </label>
                    <input type="text" id="slug" name="slug" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="en minuscula, sin caracteres especiales y en vez de espacios guiones" required />
                </div>
                <div>
                    <label for="presentacion" class="block text-sm font-medium text-gray-700">Presentación</label>
                    <input type="text" id="presentacion" name="presentacion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
                </div>
                <div>
                    <label for="componentes" class="block text-sm font-medium text-gray-700">Componentes</label>
                    <input type="text" id="componentes" name="componentes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
                </div>
                <div>
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-32" required></textarea>
                </div>
                <div>
                    <label for="indicaciones" class="block text-sm font-medium text-gray-700">Indicaciones</label>
                    <textarea id="indicaciones" name="indicaciones" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-32" required></textarea>
                </div>
                <div>
                    <label for="contraindicaciones" class="block text-sm font-medium text-gray-700">Contraindicaciones</label>
                    <textarea id="contraindicaciones" name="contraindicaciones" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-32" required></textarea>
                </div>
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" id="stock" name="stock" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
                </div>
                <div>
                    <label for="precio_compra" class="block text-sm font-medium text-gray-700">Precio de Compra</label>
                    <input type="number" id="precio_compra" name="precio_compra" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
                </div>
                <div>
                    <label for="precio_venta" class="block text-sm font-medium text-gray-700">Precio de Venta</label>
                    <input type="number" id="precio_venta" name="precio_venta" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
                </div>
                <div>
                    <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen</label>
                    <input type="file" id="imagen" name="imagen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
                </div><br>
                <div>
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded-md">Agregar</button>
                </div>
            </form>
            
        </div>
    </div>
</div>