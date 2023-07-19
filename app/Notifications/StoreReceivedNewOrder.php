<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StoreReceivedNewOrder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail', 'nexmo'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Um novo pedido foi solicitado!')
                    ->greeting('Olá vendedor, tudo bem?')
                    ->line('Um novo pedido foi solicitado na loja!')
                    ->action('Ver pedido', url('admin.orders.my'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Um novo pedido foi solicitado'
        ];
    }

//   até o momento não há uma atualização disponivel do nexmo para o laravel 10
//   public function toNexmo($notifiable)
//   {
//        return (new NexmoMessage)
//                ->content('Você recebeu um novo pedido em nosso site!');
//                ->from('número');
//                ->unicode();
//   }
}
