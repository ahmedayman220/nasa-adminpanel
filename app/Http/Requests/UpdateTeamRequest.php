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
                'unique:teams,project_proposal_url,' . request()->route('team')->id,
            ],
            'project_video_url' => [
                'string',
                'min:3',
                'max:200',
                'required',
                'unique:teams,project_video_url,' . request()->route('team')->id,
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
