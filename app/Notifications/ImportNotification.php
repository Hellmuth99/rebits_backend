<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ImportNotification extends Notification
{
    use Queueable;

    protected $totalRows;
    protected $success;

    /**
     * Create a new notification instance.
     */
    public function __construct($totalRows, $success)
    {
        $this->totalRows = $totalRows;
        $this->success = $success;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $message = $this->success ? 'Importación completada correctamente.' : 'Hubo errores durante la importación.';

        return (new MailMessage)
            ->subject('Resultado de la importación desde Excel')
            ->line($message)
            ->line("Total de filas procesadas: {$this->totalRows}");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
