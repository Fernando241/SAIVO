<x-mail::message>
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

</x-mail::message>
