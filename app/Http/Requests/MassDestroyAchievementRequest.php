<?php

namespace App\Http\Requests;

use App\Models\Achievement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAchievementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('achievement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:achievements,id',
        ];
    }
}
