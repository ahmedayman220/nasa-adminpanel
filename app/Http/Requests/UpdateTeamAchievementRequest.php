<?php

namespace App\Http\Requests;

use App\Models\TeamAchievement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTeamAchievementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('team_achievement_edit');
    }

    public function rules()
    {
        return [
            'earned_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
