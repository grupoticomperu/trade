<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Crm;

class CrmGanadoNotification extends Notification
{
    use Queueable;


    public function __construct(public Crm $crm)
    {
        //
    }


    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }


    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('CRM marcado como GANADO')
            ->greeting('Hola ' . $notifiable->name)
            ->line('El CRM "' . $this->crm->id . '" ha sido marcado como GANADO.')
            ->action('Ver Ganados', route('admin.crms.ganados'))
            ->line('Gracias por tu atención.');
    }


    public function toDatabase($notifiable)
    {
        return [
            'crm_id' => $this->crm->id,
            'mensaje' => 'El CRM "' . $this->crm->id . '" fue marcado como GANADO.',
            'url' => route('admin.crms.ganados'),
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
