<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\QrEmailGenerateJob;
use App\Models\BootcampParticipant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QrGeneratorController extends Controller
{
    public function generateAndEmail(Request $request,BootcampParticipant $participant) {

        foreach($request->ids as $id) {
            $id = $participant->find($id)->bootcampParticipantBootcampAttendees->first()->id;
            QrEmailGenerateJob::dispatch($id,auth()->user()->id, $request->host());
        }
        session()->flash('Status','Your request is processing please wait..');
        return response(null);

    }


    public function scanBootcampAttendee($value,BootcampParticipant $participant){
        $Participant_info = $participant->where('national',$value)->first();
        if(!$Participant_info){
            return back()->with('Failed','User not found');
        }
        if($Participant_info->bootcampParticipantBootcampAttendees->first()->attendance_status == 'attended'){
            return back()->with('Failed','User already attended');
        }
        $Participant_info->bootcampParticipantBootcampAttendees->first()->update(['attendance_status' => 'attended','check_in_time' => Carbon::now()]);
        return back()->with('Status','Scan success');
    }


    public function scanWorkshop($value,BootcampParticipant $participant){
        $Participant_info = $participant->where('national',$value)->first();
        if(!$Participant_info){
            return back()->with('Failed','User not found');
        }
        if($Participant_info->bootcampParticipantParticipantWorkshopAssignments->first()->attendance_status == 'attended'){
            return back()->with('Failed','User already attended');
        }
        $Participant_info->bootcampParticipantParticipantWorkshopAssignments->first()->update(['attendance_status' => 'attended','check_in_time' => Carbon::now()]);
        return back()->with('Success','Scan success');
    }
}
