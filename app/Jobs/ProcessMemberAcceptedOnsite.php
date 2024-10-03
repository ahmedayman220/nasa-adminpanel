<?php

namespace App\Jobs;

use App\Mail\TransportationMail;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ProcessMemberAcceptedOnsite implements ShouldQueue {

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 5; // Retry up to 5 times if the job fails
    public $backoff = 1; // Wait 1 seconds between retries

    private $member;
    private $team;

    public function __construct($team, $member)
    {
        $this->member = $member;
        $this->team = $team;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Try sending the email
            Mail::to("ahmeday.maks@gmail.com")->send(new TransportationMail($this->team, $this->member));
        } catch (Exception $e) {
            // Log the error for debugging and tracking
            Log::error("Failed to send email to {$this->member->email}. Error: {$e->getMessage()}");

            // Optionally, you can rethrow the exception to ensure retry mechanisms kick in
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(Exception $exception)
    {
        // Log the failure for further analysis
        Log::error("Job for sending email to {$this->member->email} has failed permanently. Error: {$exception->getMessage()}");

        // Notify an administrator or take other actions if necessary
        // Example: Send a notification to admin about the failure
    }
}
