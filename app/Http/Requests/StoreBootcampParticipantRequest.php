<?php

namespace App\Http\Requests;

use App\Models\BootcampParticipant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class StoreBootcampParticipantRequest extends FormRequest
{
    public function authorize()
    {
//        return Gate::allows('bootcamp_participant_create');
        return true;
    }

    public function rules()
    {
        return [
            'name_en' => [
                'string',
                'required',
            ],
            'name_ar' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:bootcamp_participants',
            ],
            'age' => [
                'string',
                'required',
            ],
            'phone_number' => [
                'string',
                'required',
            ],
            'educational_level_id' => [
                'required',
                'integer',
            ],
            'field_of_study_id' => [
                'required',
                'integer',
            ],
            'educational_institute' => [
                'string',
                'required',
            ],
            'graduation_year' => [
                'string',
                'required',
            ],
            'position' => [
                'string',
                'required',
            ],
            'national' => [
                'string',
                'required',
                'unique:bootcamp_participants',
            ],
            'national_id_front' => [
                'required',
            ],
            'national_id_back' => [
                'required',
            ],
            'is_participated' => [
                'required',
            ],
            'participated_year' => [
                'string',
                'nullable',
            ],
            'is_attend_formation_activity' => [
                'required',
            ],
            'first_priority_id' => [
                'required',
                'integer',
            ],
            'why_this_workshop' => [
                'string',
                'required',
            ],
            'is_have_team' => [
                'required',
            ],
            'comment' => [
                'string',
            ],
            'year' => [
                'string',
            ],
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        // Return a JSON response with the validation errors and a 422 status code
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $errors,
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
