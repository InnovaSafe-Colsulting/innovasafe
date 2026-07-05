<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SolicitudAsesoriaMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array $datos
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva Solicitud de Asesoría - InnovaSafe',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.solicitud-asesoria',
        );
    }
}
