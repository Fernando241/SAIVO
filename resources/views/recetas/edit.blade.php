@extends('template.template')

@section('title', 'editar receta')

@section('content')
    <div class="container w-[80%]">
        <h1>Editar Receta</h1>
        <a href="{{ route('recetas.index') }}" class="p-2 bg-green-700 rounded-lg hover:bg-green-600 text-white">Volver</a><br><br>
        <!-- formulario para editar receta -->
        <form action="{{ route('recetas.update', $receta->id) }}" method="POST" enctype="multipart/form-data" id="solicitudForm">
            @csrf
            @method('PUT')
            <!-- input para el título de la receta -->
            <div>
                <label for="titulo" class="text-green-900">Título</label>
                <input type="text" id="titulo" name="titulo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $receta->titulo }}" required />
            </div>
            <!-- input para los ingredientes de la receta -->
            <div>
                <label for="ingredientes" class="text-green-900">Ingredientes</label>
                <input type="text" id="ingredientes" name="ingredientes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $receta->ingredientes }}" required>
            </div>
            <div>
            <!-- input para la preparación de la receta -->
            <div>
                <label for="preparacion" class="text-green-900">Preparación</label>
                <textarea id="preparacion" name="preparacion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ $receta->preparacion }}</textarea>
            </div>
            {{-- input para el uso de la receta --}}
            <div>
                <label for="uso" class="text-green-900">Uso</label>
                <input type="text" id="uso" name="uso" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $receta->uso }}" required>
            </div>
            <!-- input para la imagen de la receta -->
            <div>
                <label for="imagen" class="text-green-900">Imagen</label>
                <input type="file" id="imagen" name="imagen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div><br>
            <button type="submit" class="bg-green-700 p-2 rounded-md hover:bg-green-500 text-white">Editar Receta</button>
        </form>
    </div>
@endsection

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