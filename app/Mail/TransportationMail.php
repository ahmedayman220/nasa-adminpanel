<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class TransportationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    private $team;
    private $currentMember;
    public function __construct($team,$currentMember)
    {
        $this->team = $team;
        $this->currentMember = $currentMember;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'NASA Space Apps Cairo 2024 Hackathon: Important Notes!',
        );
    }

    /**
     * Get the message content definition.
     */

    public function getShortNameAttribute($name)
    {
        $words = explode(' ', $name); // Assuming 'name' is your column
        return implode(' ', array_slice($words, 0, 2)); // Return only the first two words
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.transportaionOnsiteAcceptedOnsite',
            with: [
                'team' => $this->team,
                'currentMember' => $this->currentMember,
                'name' => $this->getShortNameAttribute($this->currentMember->name),
                'transportation' => $this->currentMember->transportation->title,
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
