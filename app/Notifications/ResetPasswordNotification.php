<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url('https://grupoconstrufacil.com.br/cotacao/trocar_senha.html?token=' . $this->token . '&email=' . urlencode($notifiable->email));

        return (new MailMessage)
                    ->line('Você está recebendo este email porque recebemos um pedido de recuperação de senha para sua conta.')
                    ->action('Redefinir Senha', $url)
                    ->line('Se você não solicitou a redefinição de senha, nenhuma ação adicional é necessária.');
    }
}
