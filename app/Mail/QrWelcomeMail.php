<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QrWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    private $national;
    private $name;
    private $workshop;
    private $time;
    /**
     * @param $national
     * @param $name
     */
    public function __construct($national, $name,$time,$workshop)
    {
        $this->national = $national;
        $this->name = $name;
        $this->time = $time;
        $this->workshop = $workshop;
    }
    /**
     * Create a new message instance.
     */

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Qr Welcome Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.welcome',
            with: ['national' => $this->national,
                   'name' => $this->name,
                    'workshop' => $this->workshop,
                    'time' => $this->time
                ],
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
