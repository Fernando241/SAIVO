<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class VerificacionEmailPersonalizada extends VerifyEmail
{
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('🌿 Verifica tu correo - Naturaleza Sagrada')
            ->greeting('¡Bienvenido a Naturaleza Sagrada S.A.S.!')
            ->line('Gracias por registrarte en nuestra tienda de productos naturales.')
            ->line('Por favor haz clic en el siguiente botón para verificar tu correo electrónico:')
            ->action('Verificar correo', $verificationUrl)
            ->line('Si tú no creaste esta cuenta, puedes ignorar este mensaje.')
            ->salutation("Gracias,\nNaturaleza Sagrada S.A.S. 🌿");
    }
}

