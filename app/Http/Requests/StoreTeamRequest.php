<?php

namespace App\Http\Requests;

use App\Models\Team;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTeamRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
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
            'team_photo' => [
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
            'team_rating' => [
                'numeric',
            ],

            'total_score' => [
                'numeric',
            ],
            'submission_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'extra_field' => [
                'string',
                'nullable',
            ],
        ];
    }
}
