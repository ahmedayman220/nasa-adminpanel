<?php

namespace App\Http\Requests;

use App\Models\BootcampConfirmation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBootcampConfirmationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
//            'recaptchaToken' => [
//                'required',
//            ],
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'email', // Ensure the email is valid
                'exists:bootcamp_participants,email', // Ensure the email exists in the table
            ],
            'national' => [
                'required',
                'integer',
                'exists:bootcamp_participants,national', // Ensure the national number exists in the table
            ],
            'phone_number' => [
                'string',
                'required',
            ],
        ];
    }
}
