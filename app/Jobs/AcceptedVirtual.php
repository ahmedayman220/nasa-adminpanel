<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log; // For error logging
use Throwable;

class AcceptedVirtual implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $members;
    private $base_url;
    private $team;

    /**
     * The number of attempts to retry the job before failing.
     *
     * @var int
     */
    public $tries = 3; // Set how many times to retry

    /**
     * Create a new job instance.
     */
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
        $delay = now(); // Initialize delay time

        try {
            // Dispatch individual jobs for each member with a delay
            foreach ($this->members as $member) {
                // Dispatch the job for each member with a delay of 2 seconds between jobs
                ProcessMemberAcceptedVirtual::dispatch($member, $this->base_url, $this->team)
                    ->delay($delay); // Delays dispatch by calculated delay time

                // Increment the delay by 2 seconds for the next member
                $delay = $delay->addSeconds(2);
            }
        } catch (Throwable $e) {
            // Log the error with relevant details
            Log::error('Error dispatching jobs in AcceptedVirtual', [
                'message' => $e->getMessage(),
                'members' => $this->members,
                'team' => $this->team,
                'base_url' => $this->base_url,
            ]);

            // Optionally rethrow the exception if you want the job to retry
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(Throwable $exception)
    {
        // Log the error when the job fails completely
        Log::error('AcceptedVirtual job failed after retries', [
            'exception' => $exception->getMessage(),
            'members' => $this->members,
            'team' => $this->team,
            'base_url' => $this->base_url,
        ]);

        // You can also notify admins or take further action here if necessary
    }
}
