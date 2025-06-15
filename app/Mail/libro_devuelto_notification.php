<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class libro_devuelto_notification extends Mailable
{
    use Queueable, SerializesModels;

    public $mensaje;

    /**
     * Create a new message instance.
     */
    public function __construct($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    public function build()
    {
    return $this->subject('Libro Devuelto')
            ->view('emails.libro_devuelto_notification')
            ->with(['mensaje' => $this->mensaje]); // PASO CRÍTICO
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Libro Devuelto Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.libro_devuelto_notification',
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
