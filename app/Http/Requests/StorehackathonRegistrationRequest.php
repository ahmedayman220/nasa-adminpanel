<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHackathonRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hackathon_registration_create');
    }

    public function rules()
    {
        return [
            // Team validation rules

            'team_leader_id' => [
                'required',
                'integer',
            ],
            'team_name' => [
                'string',
                'min:3',
                'max:50',
                'required',
            ],
            'challenge_id' => [
                'required',
                'integer',
            ],
            'actual_solution_id' => [
                'required',
                'integer',
            ],
            'mentorship_needed_id' => [
                'required',
                'integer',
            ],
            'participation_method_id' => [
                'required',
                'integer',
            ],
            'limited_capacity' => [
                'required',
            ],
            'members_participated_before' => [
                'required',
            ],
            'project_proposal_url' => [
                'string',
                'min:3',
                'max:200',
                'required',
                'unique:teams',
            ],
            'project_video_url' => [
                'string',
                'min:3',
                'max:200',
                'required',
                'unique:teams',
            ],
            'team_photo' => [
                'required',
            ],
            'national_id_photo' => [
                'required',
            ],
            // Member validation rules
            'members.*.national' => [
                'string',
                'min:3',
                'max:100',
                'required',
                'unique:members',
            ],
            'members.*.national_id_photo' => [
                'required',
            ],
            'members.*.name' => [
                'string',
                'min:3',
                'max:100',
                'required',
            ],
            'members.*.email' => [
                'required',
                'email',
                'unique:members',
            ],
            'members.*.phone_number' => [
                'string',
                'min:3',
                'max:100',
                'required',
                'unique:members',
            ],
            'members.*.age' => [
                'string',
                'min:3',
                'max:100',
                'required',
            ],
            'members.*.is_new' => [
                'required',
            ],
            'members.*.major_id' => [
                'required',
                'integer',
            ],
            'members.*.organization' => [
                'string',
                'min:1',
                'max:100',
                'required',
            ],
            'members.*.participant_type' => [
                'required',
            ],
            'members.*.study_level_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
