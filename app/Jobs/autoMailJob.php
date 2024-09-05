<?php

namespace App\Jobs;

use App\Mail\QrWelcomeMail;
use App\Models\BootcampAttendee;
use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class autoMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $base_url;
    private $participants;

    /**
     * @param $base_url
     * @param $participants
     */
    public function __construct($participants,$base_url)
    {
        $this->base_url = $base_url;
        $this->participants = $participants;
    }

    /**
     * @param $base_url
     */



    /**
     * Execute the job.
     */
    public function handle(BootcampAttendee $attendeeModel,\App\Models\QrCode $qrModel,Email $email): void
    {
        $relative_name = null; // Initialize the variable here
        $Schedule_time = null;
        $workshop = null;
        foreach ($this->participants as $participant){
            $id = $participant->id;
            try{
                // Get attendee id and update status
                $attendee = $attendeeModel->find($id);
                // Get participant id to generate Qr code
                $data = $attendee->bootcamp_participant;

                $relative_name = 'QR/' . uniqid().'_'.$data->national.'.png';
                $path = public_path($relative_name);
                $url = $this->base_url . '/' . $relative_name;
                QrCode::format('png')->size(200)->generate($data->national, $path);
                // Pass needed info to email
                $participantWorkshopRelation = $data->bootcampParticipantParticipantWorkshopAssignments->first();
                if($participantWorkshopRelation){
                    $schedule = $participantWorkshopRelation->workshop_schedule;
                    $Schedule_time = $schedule->schedule_time;
                    $workshop = $schedule->workshop->title;
                }

                Mail::to($data->email)->send(new QrWelcomeMail($url, $data->national, $data->name_en, $Schedule_time, $workshop));

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
                    'created_by_id' => 1
                ]);
            } catch (\Exception $e) {
                // Handle exceptions here

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
                    'status' => 0,
                    'qrcode_id' => $latest_id,
                    'bootcamp_participant_email_id' => $data->id,
                    'created_by_id' => 1
                ]);
            }
        }

    }
}
