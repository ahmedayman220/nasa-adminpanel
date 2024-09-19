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

    private $uuid;
    private $name;
    private $workshop;
    private $time;
    private $workshop_description;
    private $path;
    /**
     * @param $national
     * @param $name
     */
    public function __construct($path,$uuid, $name,$time,$workshop,$workshop_description)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->time = $time;
        $this->workshop = $workshop;
        $this->workshop_description = $workshop_description;
        $this->path = $path;
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
            subject: 'NASA Space Apps Cairo 2024 Bootcamp Transportation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.transportationEmail',
            with: [
                    'uuid' => $this->uuid,
                   'name' => $this->name,
                    'workshop' => $this->workshop,
                    'workshop_description' => $this->workshop_description,
                    'time' => $this->time,
                    'path' => $this->path
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
