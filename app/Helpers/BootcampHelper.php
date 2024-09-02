<?php

namespace App\Helpers;

use App\Models\BootcampDetail;
use App\Models\WorkshopSchedule;
use App\Models\Workshop;
use App\Models\ParticipantWorkshopAssignment;
use App\Models\ParticipantWorkshopPreference;
use App\Models\BootcampAttendee;
use Illuminate\Support\Carbon;

class BootcampHelper
{
    public static function checkAvailability($id)
    {
        // Get the bootcamp details
        $bootcamp = BootcampDetail::first(); // Assuming there's only one bootcamp

        // Check if bootcamp has available capacity
        $attendeesCount = $bootcamp->bootcampDetailsBootcampAttendees->count();
        if ($attendeesCount >= $bootcamp->total_capacity) {
            return response('No available slots in the bootcamp.');
        }

        // Get user workshop preferences
        $preferences = ParticipantWorkshopPreference::where('bootcamp_participant_id', $id)
            ->orderBy('preference_order')
            ->get();

        // Check each workshop preference for availability
        foreach ($preferences as $preference) {
            //
            $schedules = Workshop::find($preference->workshop_id)->workshopWorkshopSchedules()->get(); // workshop
//            dd($workshops->get());
            foreach ($schedules as $schedule) {
                if ($schedule->checkSchedualWorkshopAvailability()) {
                    // Assign the user to this workshop and return success
                    $participantWorkshopAssignment = ParticipantWorkshopAssignment::create([
                        'bootcamp_participant_id' => $id,
                        'workshop_schedule_id' => $schedule->id,
                        'attendance_status' => 'assigned',
                        'check_in_time' => Carbon::now()
                    ]);

                    // Create a new BootcampAttendee record
                    $bootcampAttendee = BootcampAttendee::create([
                        'bootcamp_details_id' => $bootcamp->id,
                        'bootcamp_participant_id' => $id,
                        'category' => 1, // workshop_attendee
                        'attendance_status' => 'registered',
                        'check_in_time' => Carbon::now()
                    ]);

                    return response('User assigned to workshop: ' . $schedule->workshop->title);
                }
            }
        }

        // If no workshop is available but bootcamp has capacity, create a BootcampAttendee record
        $bootcampAttendee = BootcampAttendee::create([
            'bootcamp_details_id' => $bootcamp->id,
            'bootcamp_participant_id' => $id,
            'category' => 0,
            'attendance_status' => 'registered',
            'check_in_time' => Carbon::now()
        ]);

        return 'No workshops available, but the user can still join the bootcamp.';
    }
}
