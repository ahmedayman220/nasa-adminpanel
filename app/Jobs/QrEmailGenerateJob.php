<?php

namespace App\Jobs;

use App\Mail\QrWelcomeMail;
use App\Models\BootcampAttendee;
use App\Models\BootcampParticipant;
use App\Models\Email;
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
    /**
     * Create a new job instance.
     */
    public function __construct($id,$adminId,$base_url)
    {
        $this->id = $id;
        $this->adminId = $adminId;
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

    public function handle(BootcampAttendee $attendeeModel,\App\Models\QrCode $qrModel,Email $email): void
    {
        $relative_name = null; // Initialize the variable here
        try{
            // Get attendee id and update status
            $attendee = $attendeeModel->find($this->id);
            // Get participant id to generate Qr code
            $data = $attendee->bootcamp_participant;

            $name = $this->getShortNameAttribute($data->name_en);
            Mail::to('ahmeday.maks@gmail.com')
                ->cc('hassan.mostafa@ieeeypegypt.org')
                ->send(new QrWelcomeMail($name));

            $email->create([
                'status' => 1,
                'qrcode_id' => 40,
                'bootcamp_participant_email_id' => $data->id,
                'created_by_id' => $this->adminId
            ]);
        } catch (\Exception $e) {
            $email->create([
                'status' => 0,
                'qrcode_id' => 40,
                'bootcamp_participant_email_id' => $data->id,
                'created_by_id' => $this->adminId
            ]);
        }
    }}
