<?php

namespace App\Http\Requests;

use App\Models\ChallengeCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateChallengeCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('challenge_category_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
