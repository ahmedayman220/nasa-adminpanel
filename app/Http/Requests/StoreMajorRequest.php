<?php

namespace App\Http\Requests;

use App\Models\Major;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMajorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('major_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'extra_field' => [
                'string',
                'nullable',
            ],
        ];
    }
}
