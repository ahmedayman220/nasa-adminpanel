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

    private $ids;
    private $adminId;
    /**
     * Create a new job instance.
     */
    public function __construct($ids,$adminId)
    {
        $this->ids = $ids;
        $this->adminId = $adminId;
    }

    /**
     * Execute the job.
     */
    public function handle(BootcampAttendee $attendeeModel,\App\Models\QrCode $qrModel,Email $email): void
    {
        foreach ($this->ids as $id){
            // Get attendee id and update status
            $attendee = $attendeeModel->find($id);
            // Get participant id to generate Qr code
            $data = $attendee->bootcamp_participant;
            $path =public_path('QR/'.uniqid().'_'.$data->national.'.png');
            QrCode::format('png')->size(200)->generate($data->national, $path);
            // Pass needed info to email
            $schedule = $data->bootcampParticipantParticipantWorkshopAssignments
                           ->first()->workshop_schedule;
            $Schedule_time = $schedule->schedule_time;
            $workshop=$schedule->workshop->title;
            try{
                Mail::to($data->email)->send(new QrWelcomeMail($data->national,$data->name_en,$Schedule_time,$workshop));
                // Insert data in Qr Model
                $qrModel->create([
                    'qr_code_value' => $path,
                    'status' => 1,
                    'bootcamp_participant_id'=>$data->id
                ]);
                // Get last inserted id
                $latest_id = $qrModel->latest()->first()->id;
                // Now, create Email data row
                $email->create([
                    'status' => 1,
                    'qrcode_id'=>$latest_id,
                    'bootcamp_participant_email_id' => $data->id,
                    'created_by_id' => $this->adminId
                ]);
            } catch (\Exception $e){
                // Insert data in Qr Model
                $qrModel->create([
                    'qr_code_value' => $path,
                    'status' => 1,
                    'bootcamp_participant_id'=>$data->id
                ]);
                // Get last inserted id
                $latest_id = $qrModel->latest()->first()->id;
                // Now, create Email data row
                $email->create([
                    'status' => 0,
                    'qrcode_id'=>$latest_id,
                    'bootcamp_participant_email_id' => $data->id,
                    'created_by_id' => $this->adminId
                ]);
            }

        }
    }
}
