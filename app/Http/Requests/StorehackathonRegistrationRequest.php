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
                'required',
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
                'max:200',
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
}
