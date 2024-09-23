<?php

namespace App\Http\Requests;

use App\Models\DifficultyLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDifficultyLevelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('difficulty_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:difficulty_levels,id',
        ];
    }
}
