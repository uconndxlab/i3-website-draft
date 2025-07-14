<?php

namespace App\Jobs;

use App\Models\ContactSubmission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendContactSubmissionSummary implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Get all unsent submissions
        $submissions = ContactSubmission::unsent()->get();

        if ($submissions->isEmpty()) {
            return;
        }

        // Send email summary
        Mail::send('emails.contact-submission-summary', [
            'submissions' => $submissions,
            'count' => $submissions->count()
        ], function ($message) {
            $message->to(config('mail.admin_email', 'i3@uconn.edu'))
                    ->subject('New Contact Form Submissions - ' . now()->format('M j, Y'));
        });

        // Mark all submissions as sent
        $submissions->each(function ($submission) {
            $submission->update([
                'is_sent' => true,
                'sent_at' => now()
            ]);
        });
    }
}
