<?php

namespace App\Http\Requests;

use App\Models\DifficultyLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDifficultyLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('difficulty_level_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
