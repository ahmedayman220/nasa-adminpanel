<?php

namespace App\Http\Requests;

use App\Models\TeamAchievement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTeamAchievementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('team_achievement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:team_achievements,id',
        ];
    }
}
