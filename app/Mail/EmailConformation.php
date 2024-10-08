<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class EmailConformation extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $url;
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
        // $this->url = URL::temporarySignedRoute(
        //     'verify-email',
        //     now()->addMinutes(5),
        //     ['token' => $encryptedKey]
        // );
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'BOOKING CONFIRMATION',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }
    public function build()
    {
        return $this->markdown('Email.confrmation')
            ->with([
                'data' => $this->data,
                // 'url' => $this->url
            ]);
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
