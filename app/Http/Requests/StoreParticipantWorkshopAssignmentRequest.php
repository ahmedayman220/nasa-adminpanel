<?php

namespace App\Http\Requests;

use App\Models\ParticipantWorkshopAssignment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreParticipantWorkshopAssignmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('participant_workshop_assignment_create');
    }

    public function rules()
    {
        return [
            'bootcamp_participant_id' => [
                'required',
                'integer',
            ],
            'workshop_schedule_id' => [
                'required',
                'integer',
            ],
            'attendance_status' => [
                'required',
            ],
            'check_in_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
        ];
    }
}
