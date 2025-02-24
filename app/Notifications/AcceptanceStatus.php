<?php

namespace App\Notifications;

use App\Mail\NotificationAcceptance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailer;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class AcceptanceStatus extends Notification implements ShouldQueue
{
    use Queueable;

    private $message;
    private $image;
    /**
     * Create a new notification instance.
     */
    public function __construct($message, $image)
    {
        //
        // dd($message);
        $this->image = $image;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): Mailable
    {
        return (new NotificationAcceptance($notifiable, $this->message, $this->image))
                    ->subject("Status: ". $this->message)
                    ->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
