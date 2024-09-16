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
            'recaptchaToken' => [
                'required',
            ],
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
                'exists:bootcamp_participants,national', // Ensure the national number exists in the table
            ],
            'phone_number' => [
                'string',
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'recaptchaToken.required' => 'The reCAPTCHA validation is required.',
            'name.required' => 'Please provide your name.',
            'name.string' => 'Your name must be a valid string.',
            'email.required' => 'An email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.exists' => 'The provided email is not registered.',
            'national.required' => 'The national number is required.',
            'national.exists' => 'The provided national number is not registered.',
            'phone_number.required' => 'A phone number is required.',
            'phone_number.string' => 'The phone number must be a valid string.',
        ];
    }

}
