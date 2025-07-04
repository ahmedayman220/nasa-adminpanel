<?php

namespace App\Http\Requests;

use App\Models\Skill;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSkillRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('skill_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'category' => [
                'string',
                'nullable',
            ],
        ];
    }
}
