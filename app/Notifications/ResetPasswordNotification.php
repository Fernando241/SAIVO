<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordBase;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class ResetPasswordNotification extends ResetPasswordBase
{
    /**
     * Construye el mensaje de correo personalizado.
     */
    public function toMail($notifiable)
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('🔒 Restablecer Contraseña - Naturaleza Sagrada S.A.S.')
            ->greeting('Hola ' . $notifiable->name . ' 🌿')
            ->line('Recibiste este correo porque solicitaste restablecer tu contraseña.')
            ->action('Restablecer Contraseña', $resetUrl)
            ->line('Si no realizaste esta solicitud, puedes ignorar este mensaje.')
            ->salutation('Gracias por confiar en Naturaleza Sagrada S.A.S.');
    }
}

