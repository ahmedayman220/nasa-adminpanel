<?php

namespace App\Http\Requests;

use App\Models\MentorshipNeeded;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMentorshipNeededRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mentorship_needed_create');
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
