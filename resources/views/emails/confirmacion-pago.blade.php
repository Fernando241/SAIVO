{{-- <x-mail::message>
# Su compra ha sido satisfactoria!
En **Naturaleza Sagrada S.A.S.** nos complace informarle que:
Su compra ha sido satisfactoria!
Gracias por confiar en nosotros.
Le enviaremos su pedido lo más pronto posible.

## Detalles del pedido:
- **Nombre:** {{ $cliente->nombre }}
- **Teléfono:** {{ $cliente->telefono }}
- **Dirección:** {{ $cliente->direccion }}
- **Fecha:** {{ $pedido->created_at }}

## Productos:
<x-mail::table>
| Producto       | Cantidad      | Valor Unitario | Valor Total  |
| ------------- |:-------------:| --------------:| ------------:|
@foreach ($pedido->detalles as $detalle)
| {{ $detalle->producto->nombre }} | {{ $detalle->cantidad }} | ${{ number_format($detalle->precio, 2) }} | ${{ number_format($detalle->cantidad * $detalle->precio, 2) }} |
@endforeach
</x-mail::table>

**Total:** ${{ number_format($pedido->total, 2) }}

Puedes ver más detalles de tu pedido en tu cuenta.

<x-mail::button :url="route('login')">
Iniciar Sesión
</x-mail::button>

Gracias por confiar en nosotros.
**Naturaleza Sagrada S.A.S.** 🌿

</x-mail::message> --}}
<x-mail::message>
# Tu pedido fue generado con éxito 🌿

En **Naturaleza Sagrada S.A.S.** nos alegra informarte que tu pedido ha sido creado correctamente.  
Su estado actual es:

## **ESPERANDO CONFIRMACIÓN DE PAGO**

A continuación encontrarás el resumen completo de tu pedido.  
También puedes consultarlo iniciando sesión en tu cuenta cuando lo desees.

---

## Para confirmar tu pago
Para que tu pedido pase al estado:

**PAGO CONFIRMADO – PENDIENTE DE ENVÍO**

solo necesitas enviarnos el **comprobante de consignación** (*payment confirmation*)  
a cualquiera de estos canales:

- **Correo:** pedidos@naturalezasagradasas.com  
- **WhatsApp:** 320 419 5115  

Por favor incluye:  
- Comprobante o *capture* del pago  
- Tu nombre completo  

Con esto garantizamos el despacho correcto de tu pedido.

---

## Datos del cliente
- **Nombre:** {{ $cliente->nombre }}
- **Teléfono:** {{ $cliente->telefono }}
- **Dirección:** {{ $cliente->direccion }}
- **Fecha del pedido:** {{ $pedido->created_at }}

---

## Productos solicitados
<x-mail::table>
| Producto       | Cantidad      | Valor Unitario | Valor Total  |
| ------------- |:-------------:| --------------:| ------------:|
@foreach ($pedido->detalles as $detalle)
| {{ $detalle->producto->nombre }} | {{ $detalle->cantidad }} | ${{ number_format($detalle->precio, 2) }} | ${{ number_format($detalle->cantidad * $detalle->precio, 2) }} |
@endforeach
</x-mail::table>

**Total del pedido:** ${{ number_format($pedido->total, 2) }}

---

<x-mail::button :url="route('login')">
Iniciar sesión
</x-mail::button>

Gracias por permitirnos acompañarte con la esencia viva de nuestras fórmulas ancestrales.  
**Naturaleza Sagrada S.A.S.** 🌱

</x-mail::message>

