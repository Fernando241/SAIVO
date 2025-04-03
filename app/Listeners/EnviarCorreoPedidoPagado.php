<?php

namespace App\Listeners;

use App\Events\PedidoPagado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\PedidoPagadoMail;

class EnviarCorreoPedidoPagado implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct()
    {
        //
    }

    public function handle(PedidoPagado $event)
    {
        Mail::to($event->cliente->email)->send(new PedidoPagadoMail($event->pedido, $event->cliente));
    }
}
