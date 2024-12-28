<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data; 
    public function __construct($data)
    {
        $this->data = $data; // Truyền dữ liệu từ controller vào biến
    }
    

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subjectName = "YÊU CẦU ĐANG ĐƯỢC XỬ LÝ - CHÚNG TÔI SẼ SỚM LIÊN HỆ VỚI BẠN"; 
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
            html: 'template.template_message',
            with: [
                'data' => $this->data, // Đúng key
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
