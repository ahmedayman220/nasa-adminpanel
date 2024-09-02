<?php

namespace App\Http\Requests;

use App\Models\BootcampAttendee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBootcampAttendeeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bootcamp_attendee_edit');
    }

    public function rules()
    {
        return [
            'bootcamp_details_id' => [
                'required',
                'integer',
            ],
            'bootcamp_participant_id' => [
                'required',
                'integer',
            ],
            'attendance_status' => [
                'required',
            ],
            'check_in_time' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
