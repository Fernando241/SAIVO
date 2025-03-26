@extends('template.template')

@section('title', 'Recetas')

@section('content')
    <div class="container mx-auto p-4 w-[80%]">
        <h1>Bienvenidos a Nuestra Colección de Recetas y Recomendaciones para Mejorar la Salud</h1><br>
        <p class="w-[90%] m-auto">En nuestra tienda, creemos en el poder de la naturaleza para mejorar nuestra salud y bienestar. <br> En esta sección especial, encontrarás una selección de recetas caseras que te ayudarán a tratar de forma natural diversas dolencias y problemas de salud. Desde infusiones relajantes hasta remedios caseros para aliviar el dolor, cada receta está diseñada para aprovechar los beneficios de los ingredientes naturales. <br>Descubre cómo la sabiduría ancestral y los ingredientes que tienes en casa pueden convertirse en tus mejores aliados para cuidar de tu salud y la de tu familia. Explora, experimenta y disfruta de una vida más sana y equilibrada con nuestras recetas.</p><br>
        
        <!-- Modal de confirmación (oculto por defecto) -->
        <div x-data="{ show: false, formId: null }">
        <div x-show="show" 
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">
                <h2 class="text-xl font-bold text-red-700">¿Realmente quieres eliminar esta receta?</h2>
                <p class="text-gray-700 mt-2">¡Esta acción no puede deshacerse!</p>
                <div class="flex justify-between mt-4">
                    <button @click="show = false" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700 transition">Cancelar</button>
                    <button @click="document.getElementById(formId).submit();" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-800 transition">Eliminar</button>
                </div>
            </div>
        </div>
        <!-- Lista de recetas con botón eliminar -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($recetas as $receta)
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-2 text-center">{{ $receta->titulo }}</h2>
            <img src="{{ asset('images/'. $receta->imagen) }}" alt="{{ $receta->titulo }}" 
                class="w-full h-48 object-cover rounded-lg mb-4 text-center">
            
            <div class="flex justify-center">
                <button onclick="toggleReceta('{{ $receta->id }}')" 
                        class="block text-center text-green-700 hover:text-greenB font-bold py-2 transition duration-300" 
                        id="btn-{{ $receta->id }}">Ver Receta</button>
            </div>
            <div id="receta-{{ $receta->id }}" class="hidden mt-4">
                <h3 class="text-lg font-semibold text-center">Ingredientes</h3>
                <p class="mb-4">{{ $receta->ingredientes }}</p>
                <h3 class="text-lg font-semibold text-center">Preparación</h3>
                <p class="mb-4">{{ $receta->preparacion }}</p>
                <h3 class="text-lg font-semibold text-center">Uso</h3>
                <p class="mb-4">{{ $receta->uso }}</p>
            </div>
            <div>
                @can('recetas.edit')
                <a href="{{ route('recetas.edit', $receta->id) }}" 
                class="block text-center text-blue-900 hover:text-blue-700 font-bold py-2 transition duration-300">
                Editar Receta
                </a>
                @endcan
            </div>
            <div class="flex justify-center">
                @can('recetas.destroy')
                <form id="form-delete-{{ $receta->id }}" 
                    action="{{ route('recetas.destroy', $receta->id) }}" 
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" @click="show = true; formId = 'form-delete-{{ $receta->id }}'" 
                            class="block text-center text-red-900 hover:text-red-700 font-bold py-2 transition duration-300">
                        Borrar Receta
                    </button>
                </form>
                @endcan
            </div>
        </div>
        @endforeach
    </div>
</div><br>

        @can('recetas.destroy')
            <a href="{{ route('recetas.create') }}" class="bg-green-700 hover:bg-green-500 text-white hover:text-green-900 p-2 rounded-sm">Añadir nueva receta</a>
        @endcan
        
    </div>

    <script>
        function toggleReceta(id) {
            var recetaDiv = document.getElementById('receta-' + id);
            var button = document.getElementById('btn-' + id);
            if (recetaDiv.classList.contains('hidden')) {
                recetaDiv.classList.remove('hidden');
                button.textContent = 'Ocultar Receta';
            } else {
                recetaDiv.classList.add('hidden');
                button.textContent = 'Ver Receta';
            }
        }
    </script>
@endsection
