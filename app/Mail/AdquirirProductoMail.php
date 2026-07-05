<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdquirirProductoMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array $cliente,
        public array $productos
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva Solicitud de Adquisición de Producto - InnovaSafe',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.adquirir-producto',
        );
    }
}
