<?php

namespace App\Http\Requests;

use App\Models\BootcampConfirmation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBootcampConfirmationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bootcamp_confirmation_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email_id' => [
                'required',
                'integer',
            ],
            'national_id' => [
                'required',
                'integer',
            ],
            'phone_number' => [
                'string',
                'required',
            ],
        ];
    }
}
