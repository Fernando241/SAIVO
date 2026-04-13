<x-mail::message>
# ¡Tu pedido de bienestar está listo, {{ $cliente->nombre }}! 🌿

En **Naturaleza Sagrada S.A.S. BIC**, nos llena de alegría saber que pronto disfrutarás de nuestras fórmulas ancestrales. Tu pedido ha sido generado **correctamente** y estamos ansiosos por prepararlo para ti.

## Estado actual: <br>**PENDIENTE DE PAGO** ✨

---

### 🔑 Un último paso para activar tu envío
Para que podamos despachar tu paquete hoy mismo, por favor realiza tu pago a través de nuestra llave segura y envíanos el comprobante:

* **Llave (Bre-B):** `0090887342`
* **A nombre de:** Naturaleza Sagrada

**¿A dónde envío el comprobante?**
Puedes responder a este mismo correo o enviarlo por

* **WhatsApp** al [321 972 9331](https://wa.me/573219729331?text=%C2%A1Hola%21%20Soy%20{{ urlencode($cliente->nombre) }}%2C%20aqu%C3%AD%20est%C3%A1%20el%20pago%20de%20mi%20pedido.%20%F0%9F%8C%BF).
* ¡Estaremos atentos para darte prioridad!

---
@php
    $subtotalCalculado = $pedido->total / 1.19;
    $ivaCalculado = $pedido->total - $subtotalCalculado;    
@endphp

### 📦 Resumen de tu pedido
<x-mail::table>
| Producto | Cant. | Total |
| :--- | :---: | ---: |
@foreach ($pedido->detalles as $detalle)
| {{ $detalle->producto->nombre }} | {{ $detalle->cantidad }} | ${{ number_format($detalle->cantidad * $detalle->precio) }} |
@endforeach
| | **Subtotal** | ${{ number_format($subtotalCalculado) }} |
| | **IVA (19%)** | ${{ number_format($ivaCalculado) }} |
</x-mail::table>

<div style="text-align: right; font-size: 16px;">
**Total a pagar: ${{ number_format($pedido->total) }}**<br>
<small style="color: #2d572c;">¡Tu envío es totalmente gratis para Bogotá y Cundinamarca!</small>
</div>

---

### 🚚 Datos de entrega
* **Dirección:** {{ $cliente->direccion }}
* **Teléfono:** {{ $cliente->telefono }}
* **Fecha:** {{ $pedido->created_at->format('d/m/Y') }}

<x-mail::button :url="route('login')">
Ver mi pedido en la tienda
</x-mail::button>

Gracias por permitirnos acompañarte con la esencia viva de nuestras fórmulas. Estamos listos para servirte con transparencia y humanidad.

Atentamente,<br>
**El equipo de Naturaleza Sagrada S.A.S. BIC** 🌱

<x-mail::panel>
**Nota Legal:** Naturaleza Sagrada S.A.S BIC, identificada con NIT: 902.017.015-7, es Responsable del Impuesto sobre las Ventas (IVA). 
De acuerdo con la normativa vigente, los precios publicados incluyen IVA, el cual se discrimina en el resumen y en la factura electrónica correspondiente.
</x-mail::panel>
</x-mail::message>