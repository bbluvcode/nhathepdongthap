<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;
    public $otp;
    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subjectName = "MÃ OTP LOGIN"; 
        $fromEmail = env('MAIL_FROM_ADDRESS');
        return new Envelope(
            from: new Address($fromEmail, 'A&C'),
            subject: $subjectName,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'template.template_otp',
            with: [
                'OTP' => $this->otp, // Đúng key
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
