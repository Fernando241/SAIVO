<div class="bg-green-300 bg-repeat bg-[url('img/PatronW.svg')] pb-6">
    <div class="container">
        <br>
        <h1>Hola: {{ $cliente->nombre }}</h1><br>
        <div class="mx-10">
            <h3>Bienvenid@, a tu espacio personal en <strong>Naturaleza Sagrada</strong></h3>
            <br>
            <p>Aquí puedes revisar tus pedidos, actualizar tu información y seguir disfrutando de nuestros productos elaborados con fórmulas indígenas ancestrales.</p>
            <h3>🌿✨ Gracias por confiar en nosotros.</h3><br>
            <h2><b>Recuerda:</b></h2>
            <p>🔐 “Activa tu autenticación en dos pasos para mayor seguridad.”<br>🌱 “Mantén tus datos actualizados para que tus pedidos lleguen sin inconvenientes.”</p>
            <br>
            <div class="text-center">
                <a href="{{ route('profile.show') }}" class="p-2 bg-greenG hover:bg-greenB text-white rounded-xl">Editar Perfil</a>
                <a href="{{ route('clientes.edit', $cliente->id) }}" class="p-2 bg-greenG hover:bg-greenB text-white rounded-xl">Actualizar Datos</a>
                <a href="{{ route('clientes.show', $cliente->id) }}" class="p-2 bg-greenG rounded-xl hover:bg-greenB text-white">Ver Pedidos</a>
                <a href="{{ route('inicio') }}" class="p-2 bg-greenG hover:bg-greenB text-white rounded-xl">Volver al catálogo</a>
                <br><br>
                <img src="{{ asset('img/productos.jpg') }}" alt="productos" class="w-full sm:w-[50%] m-auto rounded-xl">
            </div>
        </div>
    </div>
</div>
