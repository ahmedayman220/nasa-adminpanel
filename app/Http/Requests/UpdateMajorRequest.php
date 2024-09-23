<?php

namespace App\Http\Requests;

use App\Models\Major;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMajorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('major_edit');
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
