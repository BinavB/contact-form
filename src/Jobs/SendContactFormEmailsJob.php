<?php

namespace YourVendor\ContactForm\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use YourVendor\ContactForm\Mail\AdminNotificationMail;
use YourVendor\ContactForm\Mail\UserConfirmationMail;
use YourVendor\ContactForm\Models\ContactSubmission;

class SendContactFormEmailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Number of retry attempts before failing.
     */
    public int $tries = 3;

    /**
     * Seconds to wait between retries.
     */
    public int $backoff = 60;

    public function __construct(
        public readonly ContactSubmission $submission
    ) {}

    /**
     * Execute the job.
     * Sends two emails:
     *   1. Admin notification  – to the configured admin address.
     *   2. User confirmation   – to the submitter's email.
     */
    public function handle(): void
    {
        $adminEmail = config('contact-form.admin_email');
        $adminName  = config('contact-form.admin_name', 'Admin');

        // 1. Notify the admin
        Mail::to($adminEmail, $adminName)
            ->send(new AdminNotificationMail($this->submission));

        // 2. Confirm to the submitter
        Mail::to($this->submission->email, $this->submission->name)
            ->send(new UserConfirmationMail($this->submission));
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        \Illuminate\Support\Facades\Log::error(
            'ContactForm email job failed for submission #' . $this->submission->id,
            ['error' => $exception->getMessage()]
        );
    }
}
