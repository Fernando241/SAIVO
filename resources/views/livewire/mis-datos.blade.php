<div class="bg-green-300 bg-repeat bg-[url('img/PatronW.svg')] pb-6">
    <div class="container">
        <br>
        <h1>Hola: {{ auth()->user()->name }}</h1><br>
        <div class="mx-10">
            <h3>Bienvenid@, a tu espacio personal en <strong>Naturaleza Sagrada</strong></h3>
            <br>
            <p>Aquí puedes revisar tus pedidos, actualizar tu información y seguir disfrutando de nuestros productos elaborados con fórmulas indígenas ancestrales.</p>
            <h3>🌿✨ Gracias por confiar en nosotros.</h3><br>
            <h2><b>Recuerda:</b></h2>
            <p>🔐 “Activa tu autenticación en dos pasos para mayor seguridad.”<br>🌱 “Mantén tus datos actualizados para que tus pedidos lleguen sin inconvenientes.”</p>
            <br>
            <div class="text-center">
                <div class="flex flex-col sm:flex-row justify-center items-center gap-3 w-full">
                    <a href="{{ route('profile.show') }}" 
                    class="w-[60%] sm:w-auto px-4 py-2 bg-greenG hover:bg-greenB text-white rounded-xl text-center">
                    Editar Perfil
                    </a>
                    
                    @if ($cliente)
                        <a href="{{ route('clientes.edit', $cliente->id) }}" 
                        class="w-[60%] sm:w-auto px-4 py-2 bg-greenG hover:bg-greenB text-white rounded-xl text-center">
                        Actualizar Datos
                        </a>
                        <a href="{{ route('clientes.show', $cliente->id) }}" 
                        class="w-[60%] sm:w-auto px-4 py-2 bg-greenG hover:bg-greenB text-white rounded-xl text-center">
                        Ver Pedidos
                        </a>
                    @endif
                    
                    <a href="{{ route('inicio') }}" 
                    class="w-[60%] sm:w-auto px-4 py-2 bg-greenG hover:bg-greenB text-white rounded-xl text-center">
                    Volver al catálogo
                    </a>
                </div>

            <br><br>
            <img src="{{ asset('img/paraIndex.jpg') }}" alt="productos" 
                class="w-[60%] sm:w-[50%] m-auto rounded-xl">
            </div>

        </div>
    </div>
</div>


