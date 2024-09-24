<?php

namespace App\Http\Requests;

use App\Models\TeamSkill;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTeamSkillRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('team_skill_edit');
    }

    public function rules()
    {
        return [
            'skill_id' => [
                'required',
                'integer',
            ],
            'proficiency_level' => [
                'numeric',
                'required',
            ],
        ];
    }
}
