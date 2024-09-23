<?php

namespace App\Http\Requests;

use App\Models\TshirtSize;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTshirtSizeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tshirt_size_create');
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
        ];
    }
}
