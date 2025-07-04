<?php

namespace App\Http\Requests;

use App\Models\ParticipationMethod;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreParticipationMethodRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('participation_method_create');
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
