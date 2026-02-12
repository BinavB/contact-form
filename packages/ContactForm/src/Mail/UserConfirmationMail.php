<?php

namespace ContactForm\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use ContactForm\Models\ContactSubmission;

class UserConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly ContactSubmission $submission
    ) {}

    public function envelope()
    {
        return new \Illuminate\Mail\Mailables\Envelope(
            subject: 'Thank you for contacting us',
        );
    }

    public function content()
    {
        return new \Illuminate\Mail\Mailables\Content(
            view: 'contact-form::emails.user-confirmation',
            with: [
                'submission' => $this->submission,
            ]
        );
    }

    public function attachments()
    {
        return [];
    }
}
