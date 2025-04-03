<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Pedido;
use App\Models\Cliente;

class PedidoPagadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pedido;
    public $cliente;

    public function __construct(Pedido $pedido, Cliente $cliente)
    {
        $this->pedido = $pedido;
        $this->cliente = $cliente;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Su compra ha sido satisfactoria!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pedido_pagado',
            with: [
                'pedido' => $this->pedido,
                'cliente' => $this->cliente,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}