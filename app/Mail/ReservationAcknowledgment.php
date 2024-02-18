<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationAcknowledgment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $reservation;

    /**
     * Create a new message instance.
     *
     * @param  Reservation  $reservation
     * @return void
     */

     public function __construct(ReservationAcknowledgement $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reservation Acknowledgment')
                    ->view('emails.reservation_acknowledgment');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reservation Acknowledgment',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
