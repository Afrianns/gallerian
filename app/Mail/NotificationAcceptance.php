<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationAcceptance extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $path;
    private $image;
    private $message;

    // public $theme = "rejected";
    /**
     * Create a new message instance.
     */
    public function __construct($notifiable, $message, $image)
    {
        $this->name = $notifiable->name;
        $this->path = $notifiable->UUID;
        $this->image = $notifiable->avatar;
        $this->message = $message;
        $this->image = $image;
        // dd($this->name, $this->image, $this->path, $this->message, $image);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope();
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        return new Content(
            markdown: 'mail.index',
            with: [
                "name" => $this->name,
                "image" => $this->image,
                "status" => $this->message,
                "url" => config("app.url") . '/profile/'. $this->path
            ]
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
