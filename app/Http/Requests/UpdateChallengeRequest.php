<?php

namespace App\Http\Requests;

use App\Models\Challenge;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateChallengeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('challenge_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'extra_field' => [
                'string',
                'nullable',
            ],
            'difficulty_level_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
