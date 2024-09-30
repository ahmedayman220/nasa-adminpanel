<?php

namespace App\Jobs;

use App\Mail\OnsiteAcceptedOnsiteMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OnsiteAcceptedOnsite implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $members;
    private $base_url;
    private $team;
    public function __construct($members,$base_url,$team)
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
        foreach($this->members as $member){
            // Define a null variable to identify if qr is generated or not later in the logic
            $relative_path = 'QR/'.$member->uuid.'_'.$member->national.'.png';
            $qr_path = public_path($relative_path);
            QrCode::format('png')->size(200)->generate($member->uuid, $qr_path);
            $qrGeneratedUrl = $this->base_url.'/'.$relative_path;
            try{
                // $member->email
                Mail::to("ahmeday.maks@gmail.com")->send(new OnsiteAcceptedOnsiteMail($this->team,$member,$qrGeneratedUrl));
            } catch(\Exception $e){
                throw $e;
            }

        }
    }
}
