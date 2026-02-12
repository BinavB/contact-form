<?php

namespace YourVendor\ContactForm\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use YourVendor\ContactForm\Models\ContactSubmission;

class UserConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly ContactSubmission $submission
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'We received your message – ' . $this->submission->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'contact-form::emails.user-confirmation',
            with: ['submission' => $this->submission],
        );
    }
}
