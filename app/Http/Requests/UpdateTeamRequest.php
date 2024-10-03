<?php

namespace App\Http\Requests;

use App\Models\Team;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTeamRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('team_edit');
    }

    public function rules()
    {
        return [
            'uuid' => [
                'string',
                'required',
                'unique:teams,uuid,' . request()->route('team')->id,
            ],
            'team_leader_id' => ['nullable'],
            'team_name' =>['nullable'],
            'challenge_id' => ['nullable'],
            'actual_solution_id' => ['nullable'],
            'mentorship_needed_id' => ['nullable'],
            'participation_method_id' => ['nullable'],
            'limited_capacity' => ['nullable'],
            'members_participated_before' => ['nullable'],
            'project_proposal_url' => ['nullable'],
            'project_video_url' => ['nullable'],
            'team_rating' => ['nullable'],
            'total_score' => ['nullable'],
            'submission_date' => ['nullable'],
            'extra_field' => ['nullable'],
        ];
    }
}
