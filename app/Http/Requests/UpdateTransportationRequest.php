<?php

namespace App\Http\Requests;

use App\Models\Transportation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTransportationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transportation_edit');
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
