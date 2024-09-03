<?php

namespace App\Http\Requests;

use App\Models\BootcampParticipant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBootcampParticipantRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bootcamp_participant_edit');
    }

    public function rules()
    {
        return [
            'name_en' => [
                'string',
                'required',
            ],
            'name_ar' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:bootcamp_participants,email,' . request()->route('bootcamp_participant')->id,
            ],
            'age' => [
                'string',
                'required',
            ],
            'phone_number' => [
                'string',
                'required',
            ],
            'educational_level_id' => [
                'required',
                'integer',
            ],
            'field_of_study_id' => [
                'required',
                'integer',
            ],
            'educational_institute' => [
                'string',
                'required',
            ],
            'graduation_year' => [
                'string',
                'required',
            ],
            'position' => [
                'string',
                'required',
            ],
            'national' => [
                'string',
                'required',
                'unique:bootcamp_participants,national,' . request()->route('bootcamp_participant')->id,
            ],
            'national_id_front' => [
                'required',
            ],
            'national_id_back' => [
                'required',
            ],
            'is_participated' => [
                'required',
            ],
            'participated_year' => [
                'number',
                'nullable',
            ],
            'is_attend_formation_activity' => [
                'required',
            ],
            'why_this_workshop' => [
                'string',
                'required',
            ],
            'is_have_team' => [
                'required',
            ],
            'comment' => [
                'string',
                'required',
            ],
            'year' => [
                'string',
                'required',
            ],
        ];
    }
}
