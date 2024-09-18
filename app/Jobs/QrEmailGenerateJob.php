<?php

namespace App\Jobs;

use App\Mail\QrWelcomeMail;
use App\Models\BootcampAttendee;
use App\Models\BootcampParticipant;
use App\Models\Email;
use App\Models\BootcampFormDescription;
use App\Models\WorkshopSchedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrEmailGenerateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $base_url;
    private $id;
    private $adminId;
    private $schedule;
    private $schedule_time;
    private $workshop;
    private $workshop_description;
    private $email;
    /**
     * Create a new job instance.
     */
    public function __construct($email,$base_url)
    {
        $this->email = $email;
        $this->base_url = $base_url;
    }

    /**
     * Execute the job.
     */

    public function getShortNameAttribute($name)
    {
        $words = explode(' ', $name); // Assuming 'name' is your column
        return implode(' ', array_slice($words, 0, 2)); // Return only the first two words
    }

    public function handle(\App\Models\QrCode $qrModel): void
    {
        try {
            $attendee = BootcampFormDescription::where('section_2_title', $this->email)->get();
            if ($attendee) {
                $name = $this->getShortNameAttribute($attendee->section_1_title);
                Mail::to($this->email)->send(new QrWelcomeMail($name));
            } else {
                \Log::error('No attendee found for the given email: ' . $this->email);
                // Optionally handle this case, e.g., mark the job as failed
            }
            // Check if $attendee is null
        } catch (\Exception $e) {
            // Log the error or handle it as necessary
            \Log::error('Error sending email or generating QR: ' . $e->getMessage());
            // Throw the exception to mark the job as failed
            throw $e;
        }
    }

}
