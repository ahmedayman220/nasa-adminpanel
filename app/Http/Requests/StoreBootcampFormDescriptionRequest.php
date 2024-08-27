<?php

namespace App\Http\Requests;

use App\Models\BootcampFormDescription;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBootcampFormDescriptionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bootcamp_form_description_create');
    }

    public function rules()
    {
        return [
            'section_1_title' => [
                'string',
                'nullable',
            ],
            'section_2_title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
