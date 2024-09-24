<?php

namespace App\Http\Requests;

use DB;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use App\Rules\WordCount;

class StoreHackathonRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // Team validation rules

            'recaptchaToken' => [
                'required'
            ],
            'team_leader_id' => [
                'required',
                'integer',
            ],
            'team_name' => [
                'string',
                'min:3',
                'max:50',
                'required',
                'regex:/^[A-Za-z\s]+$/',
                function ($attribute, $value, $fail) {
                    if (DB::table('teams')->whereRaw('BINARY `team_name` = ?', [$value])->exists()) {
                        $fail('The team name has already been taken.');
                    }
                },
            ],
            'comment' => [
                'nullable',
                'max:225'
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
                'nullable',
            ],
            'members_participated_before' => [
                'nullable',
            ],
            'participated_hackathons' => [
                'nullable'
            ],
            'project_proposal_url' => [
                'required',
                'string',
                new WordCount(50, 150)
            ],
            'project_video_url' => [
                'string',
                'min:3',
                'required',
                'unique:teams',
            ],
            'team_photo' => [
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
                'nullable',
            ],
            'members.*.study_level_id' => [
                'required',
                'integer',
            ],
            'members.*.tshirt_size_id' => [
                'nullable',
            ],
            'members.*.transportation_id' => [
                'nullable',
            ],

            // Custom validation to check if at least one member is onsite when participation_method_id is 1
            'members' => [
                function ($attribute, $value, $fail) {
                    if ($this->input('participation_method_id') == 1) {
                        $onsiteMemberFound = false;
                        foreach ($value as $member) {
                            if (isset($member['participant_type']) && $member['participant_type'] == 1) {
                                $onsiteMemberFound = true;
                                break;
                            }
                        }
                        if (!$onsiteMemberFound) {
                            $fail('At least one team member must have participant type "onsite" when participation method is "onsite".');
                        }
                    }
                }
            ],
        ];
    }


    public function messages()
    {
        return [
            'recaptchaToken.required' => 'Please complete the reCAPTCHA verification.',
            'team_leader_id.required' => 'The team leader is required.',
            'team_name.required' => 'The team name is required.',
            'team_name.regex' => 'The team name may only contain letters and spaces.',
            'team_name.min' => 'The team name must be at least 3 characters long.',
            'team_name.max' => 'The team name may not be longer than 50 characters.',
            'team_name.unique' => 'This team name has already been taken.',
            'comment.max' => 'The comment may not exceed 225 characters.',
            'challenge_id.required' => 'The challenge is required.',
            'actual_solution_id.required' => 'The actual solution ID is required.',
            'mentorship_needed_id.required' => 'Please specify whether mentorship is needed.',
            'participation_method_id.required' => 'The participation method is required.',
            'members_participated_before.nullable' => 'This field is optional.',
            'project_proposal_url.required' => 'The ideal description is required.',
            'project_proposal_url.string' => 'The ideal description must be a string.',
            'project_video_url.required' => 'The project video URL is required.',
            'project_video_url.unique' => 'This project video URL has already been used.',
            'team_photo.required' => 'A team photo is required.',

            // Member validation messages
            'members.*.national.required' => 'Each member must provide their nationality.',
            'members.*.national.unique' => 'This national ID has already been used.',
            'members.*.national.min' => 'The nationality must be at least 3 characters long.',
            'members.*.national_id_photo.required' => 'Each member must upload their national ID photo.',
            'members.*.name.required' => 'Each member must provide their name.',
            'members.*.email.required' => 'Each member must provide their email address.',
            'members.*.email.email' => 'Each member must provide a valid email address.',
            'members.*.email.unique' => 'This email address is already registered.',
            'members.*.phone_number.required' => 'Each member must provide their phone number.',
            'members.*.phone_number.unique' => 'This phone number is already registered.',
            'members.*.age.required' => 'Each member must provide their age.',
            'members.*.major_id.required' => 'Each member must specify their major.',
            'members.*.organization.required' => 'Each member must provide their organization.',
            'members.*.study_level_id.required' => 'Each member must specify their study level.',
        ];
    }



}
