<?php

namespace App\Http\Requests;

use App\Models\MentionYourField;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMentionYourFieldRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mention_your_field_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}
