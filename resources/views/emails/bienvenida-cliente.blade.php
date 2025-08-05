<x-mail::message>
# ¡Hola {{ $nombre }}! 🌱

Bienvenid@ al mundo de la **Salud Natural**.  

Es un gusto contarte que ahora estás registrado como **cliente y usuario** en nuestra plataforma.

Puedes iniciar sesión con tu correo: **{{ $correo }}**  
Y tu contraseña provisional: **SaludNatural**

> Te recomendamos cambiarla por una personalizada luego de tu primer ingreso.

<x-mail::button :url="route('login')">
Iniciar Sesión
</x-mail::button>

Gracias por confiar en nosotros.
**Naturaleza Sagrada S.A.S.** 🌿
</x-mail::message>
