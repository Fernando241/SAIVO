<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Pedido;
use App\Models\Cliente;

class PedidoPagado
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pedido;
    public $cliente;

    public function __construct(Pedido $pedido, Cliente $cliente)
    {
        $this->pedido = $pedido;
        $this->cliente = $cliente;
    }

    public function broadcastOn()
    {
        return [];
    }
}