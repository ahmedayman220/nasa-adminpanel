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
    public function handle(BootcampAttendee $attendeeModel,\App\Models\QrCode $qrModel,Email $email): void
    {
        $relative_name = null; // Initialize the variable here
        try{
            // Get attendee id and update status
            $attendee = $attendeeModel->find($this->id);
            // Get participant id to generate Qr code
            $data = $attendee->bootcamp_participant;

            $relative_name = 'QR/' . uniqid().'_'.$data->national.'.png';
            $path = public_path($relative_name);
            $url = $this->base_url . '/' . $relative_name;
            QrCode::format('png')->size(200)->generate($data->uuid, $path);
            // Pass needed info to email
            $participantWorkshopRelation = $data->bootcampParticipantParticipantWorkshopAssignments->first();
            if($participantWorkshopRelation){
                $this->schedule = $participantWorkshopRelation->workshop_schedule;
                $this->schedule_time = $this->schedule->schedule_time;
                $this->workshop = $this->schedule->workshop->title;
                $this->workshop_description = $this->schedule->workshop->descriptions;
            }
            //sodec14206@konetas.com
            Mail::to('62d09ac524@mailmaxy.one')->send(new QrWelcomeMail($url, $data->uuid, $data->name_en, $this->schedule_time, $this->workshop, $this->workshop_description));

            // Insert data in Qr Model
            $qrModel->create([
                'qr_code_value' => $relative_name,
                'status' => 1,
                'bootcamp_participant_id' => $data->id
            ]);

            // Get last inserted id
            $latest_id = $qrModel->latest()->first()->id;

            // Now, create Email data row
            $email->create([
                'status' => 1,
                'qrcode_id' => $latest_id,
                'bootcamp_participant_email_id' => $data->id,
                'created_by_id' => $this->adminId
            ]);
        } catch (\Exception $e) {
            // Handle exceptions here

            // Insert data in Qr Model
            $qrModel->create([
                'qr_code_value' => $e,
                'status' => 1,
                'bootcamp_participant_id' => $data->id
            ]);

            // Get last inserted id
            $latest_id = $qrModel->latest()->first()->id;

            // Now, create Email data row
            $email->create([
                'status' => 0,
                'qrcode_id' => $latest_id,
                'bootcamp_participant_email_id' => $data->id,
                'created_by_id' => $this->adminId
            ]);
        }
    }}
