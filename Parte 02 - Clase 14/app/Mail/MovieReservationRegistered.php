<?php

namespace App\Mail;

use App\Models\Movie;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MovieReservationRegistered extends Mailable
{
    use Queueable, SerializesModels;

    // /*
    //     Si la propiedad es pública, Laravel automáticamente hace disponible este valor en la vista del email.
    // */
    // public Movie $movie;

    // /**
    //  * Create a new message instance.
    //  */
    // public function __construct(Movie $movie)
    // {
    //     $this->movie = $movie;
    // }

    /*
        Versión usando "constructor property promotion"
    */
    /*
        Si la propiedad es pública, Laravel automáticamente hace disponible este valor en la vista del email.
    */
    public function __construct(
        public Movie $movie
    ) 
    {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        /*
            Envelope es para la configuración de los detalles que hacen al envío.
            Por ejemplo:
                - to
                - cc
                - bcc
                - from
                - subject

            El único requisito que todo email tiene que cumplir para poder enviarse es tener configurado
            un "from". Esto es, la dirección de correo que "firma" el email.

            Laravel les permite configurar un "from" global desde el [.env], o podemos definirlo directamente
            en cada mailable en el Envolope.
        */
        return new Envelope(
            subject: 'Reserva de película registrada',
            // from: 'no-responder@dvpeliculas.com',
            from: new Address('no-responder@dvpeliculas.com', 'DV Películas'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            /*
                En "view" ponemos la ruta de la vista que queremos renderizar.
            */
            view: 'mails.movie-reservation-registered',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
