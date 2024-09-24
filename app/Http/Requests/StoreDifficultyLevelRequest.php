<?php

namespace App\Http\Requests;

use App\Models\DifficultyLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDifficultyLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('difficulty_level_create');
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
