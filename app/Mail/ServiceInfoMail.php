<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ServiceInfoMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $whatsapp;
    public $activeServices;

    public function __construct(string $whatsapp)
    {
        $this->whatsapp = $whatsapp;
        $this->activeServices = DB::table('type_services')
            ->where('status', 1)
            ->orderBy('name')
            ->get();
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Hola, queremos que seas parte de nuestro día a día',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.service-info',
        );
    }

    public function attachments(): array
    {
        $path = public_path('resources/Portafolio_Comercial_InnovaSafe.pdf');

        if (file_exists($path)) {
            return [
                Attachment::fromPath($path)
                    ->as('Portafolio_Comercial_InnovaSafe.pdf')
                    ->withMime('application/pdf'),
            ];
        }

        return [];
    }
}
