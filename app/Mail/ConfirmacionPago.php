<?php

namespace App\Mail;

use Illuminate\Mail\Mailables\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmacionPago extends Mailable
{
    use Queueable, SerializesModels;

    public $pedido;
    public $cliente;

    /**
     * Create a new message instance.
     */
    public function __construct($cliente, $pedido)
    {
        $this->pedido = $pedido;
        $this->cliente = $cliente;
    }
    
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('contacto@naturalezasagradasas.com', 'Naturaleza Sagrada SAS'),
            subject: 'Confirmacion Pago - Naturaleza Sagrada 🌿',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.confirmacion-pago',
            with: [
                'cliente' => $this->cliente,
                'pedido' => $this->pedido,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
