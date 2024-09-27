<?php

namespace App\Jobs;

use App\Mail\TeamMembersMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRandEmailTeamMembersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $members;
    private $flag;
    private $base_url;
    public function __construct($members,$flag,$base_url)
    {
        $this->members = $members;
        $this->flag = $flag;
        $this->base_url = $base_url;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($this->members as $member){
            // Define a null variable to identify if qr is generated or not later in the logic
            $qrGeneratedUrl = null;
            // Check for used flag to know if u r gonna generate qr code or not --- flag 1 = generate
            if($this->flag){
                $relative_path = 'Team_Members_QR/'.$member->uuid.'_'.$member->national.'.png';
                $qr_path = public_path($relative_path);
                QrCode::format('png')->size(200)->generate($member->uuid, $qr_path);
                $qrGeneratedUrl = $this->base_url.'/'.$relative_path;
            }
            try{
                Mail::to($member->email)->send(new TeamMembersMail($member->name,$member->uuid,$qrGeneratedUrl));
            } catch(\Exception $e){
                throw $e;
            }

        }
    }
}
