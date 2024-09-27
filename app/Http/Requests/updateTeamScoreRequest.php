<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateTeamScoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'relevancy' => [
                'required',
                'integer',
                'min:0',
                'max:5'
            ],
            'impact' => [
                'required',
                'integer',
                'min:0',
                'max:5'
            ],
            'creativity' => [
                'required',
                'integer',
                'min:0',
                'max:5'
            ],
            'proposal' => [
                'required',
                'integer',
                'min:0',
                'max:5'
            ],
            'video' => [
                'required',
                'integer',
                'min:0',
                'max:5'
            ],
        ];
    }
}
