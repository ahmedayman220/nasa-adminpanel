<?php

namespace App\Jobs;

use App\Mail\OnsiteAcceptedOnsiteMail;
use App\Mail\TransportationMail;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Log;

class OnsiteAcceptedOnsite implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $members;
    private $base_url;
    private $team;

    public function __construct($members, $base_url, $team)
    {
        $this->members = $members;
        $this->base_url = $base_url;
        $this->team = $team;
    }

    /**
     * Execute the job.
     */


    public function handle(): void
    {
        foreach ($this->members as $member) {
            try {

                ProcessMemberAcceptedOnsite::dispatch($this->team, $member)
                ->delay(now()->addSeconds(1));
            } catch (Exception $e) {
                Log::error("Failed to process member: {$member->email}. Error: " . $e->getMessage());
                throw $e;
            }
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(Exception $exception)
    {
        // Log failure, notify admin, etc.
        Log::error('Transportation OnsiteAcceptedOnsite Job failed: ' . $exception->getMessage());
    }
}
