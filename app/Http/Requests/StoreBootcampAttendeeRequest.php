<?php

namespace App\Http\Requests;

use App\Models\BootcampAttendee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBootcampAttendeeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bootcamp_attendee_create');
    }

    public function rules()
    {
        return [
            'bootcamp_participant_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
