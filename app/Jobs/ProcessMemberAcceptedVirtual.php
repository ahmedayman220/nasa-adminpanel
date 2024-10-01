<?php
namespace App\Jobs;

use App\Mail\AcceptedVirtualMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Log; // To log errors

class ProcessMemberAcceptedVirtual implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $member;
    private $base_url;
    private $team;

    public function __construct($member, $base_url, $team)
    {
        $this->member = $member;
        $this->base_url = $base_url;
        $this->team = $team;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Generate QR code for the member
            $relative_path = 'QR/'.$this->member->uuid.'_'.$this->member->national.'.png';
            $qr_path = public_path($relative_path);
            QrCode::format('png')->size(200)->generate($this->member->uuid, $qr_path);
            $qrGeneratedUrl = $this->base_url.'/'.$relative_path;

            // Send the email to the member
            Mail::to($this->member->email)->send(new AcceptedVirtualMail($this->team, [$this->member], $this->member, $qrGeneratedUrl));
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error processing member: ' . $this->member->email . ' - ' . $e->getMessage());

            // Optionally, you can rethrow the exception if you want the job to retry
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Exception $exception)
    {
        // This method is triggered if the job fails after retry attempts
        Log::error('Job failed for member: ' . $this->member->email . ' - ' . $exception->getMessage());
    }
}
