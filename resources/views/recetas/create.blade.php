@extends('template.template')

@section('title', 'añadir receta')

@section('content')
    <h1>Añadir Receta</h1>
    <div class="container w-[80%]">
        <a href="{{ route('recetas.index') }}" class="p-2 bg-green-700 rounded-lg hover:bg-green-600 text-white">Volver</a><br><br>
        <form action="{{ route('recetas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <div> {{-- titulo --}}
                    <label for="titulo" class="text-green-900">Titulo</label>
                    <input type="text" id="titulo" name="titulo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
                </div>
                <div>{{-- ingredientes --}}
                    <label for="ingredientes" class="text-green-900">Ingredientes</label>
                    <input type="text" id="ingredientes" name="ingredientes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div> {{-- preparacion --}}
                    <label for="preparacion" class="text-green-900">Preparación</label>
                    <textarea id="preparacion" name="preparacion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>
                </div>
                <div> {{-- uso --}}
                    <label for="uso" class="text-green-900">Uso</label>
                    <input type="text" id="uso" name="uso" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div> {{-- imagen --}}
                    <label for="imagen" class="text-green-900">Imagen</label>
                    <input type="file" id="imagen" name="imagen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required />
                </div><br>
                <button type="submit" class="p-2 bg-green-700 text-white rounded-md hover:bg-green-600 text-center">Agregar Receta</button>
            </div>
        </form>
    </div>
@endsection