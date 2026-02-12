<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ContactSubmission;

class AdminNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly ContactSubmission $submission
    ) {}

    public function envelope()
    {
        return new \Illuminate\Mail\Mailables\Envelope(
            subject: 'New Contact Form Submission: ' . $this->submission->subject,
        );
    }

    public function content()
    {
        return new \Illuminate\Mail\Mailables\Content(
            view: 'contact-form::emails.admin-notification',
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
