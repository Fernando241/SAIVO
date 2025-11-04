<?php

namespace App\Mail;

/* use Address; */
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class BienvenidaCliente extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $correo;

    /**
     * Create a new message instance.
     */
    public function __construct($nombre, $correo)
    {
        $this->nombre = $nombre;
        $this->correo = $correo;
    }
    
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('contacto@naturalezasagradasas.com', 'Naturaleza Sagrada SAS'),
            subject: 'Bienvenid@ al mundo de la Salud 🌿',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.bienvenida-cliente',
            with: [
                'nombre' => $this->nombre,
                'correo' => $this->correo,
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
