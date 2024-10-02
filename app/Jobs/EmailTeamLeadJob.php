<?php

namespace App\Jobs;

use App\Mail\teamLeadMail;
use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailTeamLeadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $teamObject;
    public function __construct($teamObject)
    {
        $this->teamObject = $teamObject;
    }

    /**
     * Execute the job.
     */
    public function handle(Member $member): void
    {
        $memberObject = $member->find($this->teamObject->team_leader_id);
        if($memberObject){
            try {
                Mail::to($memberObject->email)->send(new teamLeadMail($this->teamObject,$memberObject));
            } catch (\Exception $e) {
                    Log::error("Failed to process member: {$memberObject->email}. Error: " . $e->getMessage());
                    throw $e;
             }
        }
    }
}
