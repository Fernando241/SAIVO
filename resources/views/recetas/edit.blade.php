@extends('template.template')

@section('title', 'Editar Receta')

@section('content')

    <div class="container w-[80%]">
        <h1 class="text-2xl font-bold text-green-900">Editar Receta</h1>
        <a href="{{ route('recetas.index') }}" class="p-2 bg-green-700 rounded-lg hover:bg-green-600 text-white">Volver</a>
        <br><br>

        <!-- Formulario para editar receta -->
        <form id="editRecetaForm" action="{{ route('recetas.update', $receta->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Título -->
            <div>
                <label for="titulo" class="text-green-900 font-semibold">Título</label>
                <input type="text" id="titulo" name="titulo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" value="{{ $receta->titulo }}" required />
            </div>

            <!-- Ingredientes -->
            <div>
                <label for="ingredientes" class="text-green-900 font-semibold">Ingredientes</label>
                <input type="text" id="ingredientes" name="ingredientes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" value="{{ $receta->ingredientes }}" required>
            </div>

            <!-- Preparación -->
            <div>
                <label for="preparacion" class="text-green-900 font-semibold">Preparación</label>
                <textarea id="preparacion" name="preparacion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" required>{{ $receta->preparacion }}</textarea>
            </div>

            <!-- Uso -->
            <div>
                <label for="uso" class="text-green-900 font-semibold">Uso</label>
                <input type="text" id="uso" name="uso" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" value="{{ $receta->uso }}" required>
            </div>

            <!-- Imagen -->
            <div>
                <label for="imagen" class="text-green-900 font-semibold">Imagen</label>
                <input type="file" id="imagen" name="imagen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2"/>
            </div>
            <br>

            <!-- Botón que activa el modal en lugar de enviar directamente -->
            <button type="button" onclick="openEditModal()" class="bg-green-700 p-2 rounded-md hover:bg-green-500 text-white">Editar Receta</button>
        </form>
    </div>

    <!-- Modal de Confirmación -->
    <div id="editConfirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm text-center">
            <h2 class="text-xl font-bold text-green-900 mb-4">¿Seguro que quieres actualizar esta receta?</h2>
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
            document.getElementById('editRecetaForm').submit(); // Enviar el formulario al confirmar
        });
    </script>

@endsection
