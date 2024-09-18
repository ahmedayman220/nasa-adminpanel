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

        foreach($request->ids as $key => $id) {
            $delay = now()->addSeconds($key * 1); // Delay each job by 5 seconds
            $id = $participant->where('national',$id)->first()->bootcampParticipantBootcampAttendees->first()->id;
            QrEmailGenerateJob::dispatch($id,auth()->user()->id, $request->host())->delay($delay);
        }
        session()->flash('Status','Your request is processing please wait..');
        return response(null);

    }


    public function scanBootcampAttendee($value,BootcampParticipant $participant){
        $Participant_info = $participant->where('uuid',$value)->first();
        //check if qr value isn't fake
        if(!$Participant_info){
            return back()->with('Failed','User not found');
        }
        //check if user already attended the workshop
        if($Participant_info->bootcampParticipantBootcampAttendees->first()->attendance_status == 'attended'){
            return back()->with('Failed','User already attended');
        }
        //if all clear user status will change to attended with succecss
        $Participant_info->bootcampParticipantBootcampAttendees->first()->update(['attendance_status' => 'attended','check_in_time' => Carbon::now()]);
        return back()->with('Status','Scan success');
    }


    public function scanWorkshop($value,BootcampParticipant $participant){
        $Participant_info = $participant->where('uuid',$value)->first();
        //check if qr value isn't fake
        if(!$Participant_info){
            return back()->with('Failed','User not found');
        }
        //check if user already attended the workshop
        if($Participant_info->bootcampParticipantParticipantWorkshopAssignments->first()->attendance_status == 'attended'){
            return back()->with('Failed','User already attended');
        }
        //if all clear user status will change to attended with succecss
        $Participant_info->bootcampParticipantParticipantWorkshopAssignments->first()->update(['attendance_status' => 'attended','check_in_time' => Carbon::now()]);
        return back()->with('Success','Scan success');
    }


    public function generateAndEmailIU(Request $request) {

        dd($request);
        foreach($request->ids as $key => $id) {
            $delay = now()->addSeconds($key * 1); // Delay each job by 5 seconds
            QrEmailGenerateJob::dispatch($request->id, $request->host())->delay($delay);
        }
        session()->flash('Status','Your request is processing please wait..');
        return response(null);

    }
}
