<?php

namespace App\Http\Requests;

use App\Models\Member;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMemberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('member_create');
    }

    public function rules()
    {
        return [
            'uuid' => [
                'string',
                'required',
                'unique:members',
            ],
            'national' => [
                'string',
                'min:3',
                'max:100',
                'required',
                'unique:members',
            ],
            'name' => [
                'string',
                'min:3',
                'max:100',
                'required',
            ],
            'email' => [
                'required',
                'unique:members',
            ],
            'phone_number' => [
                'string',
                'min:3',
                'max:100',
                'required',
                'unique:members',
            ],
            'age' => [
                'string',
                'min:3',
                'max:100',
                'required',
            ],
            'is_new' => [
                'required',
            ],
            'major_id' => [
                'required',
                'integer',
            ],
            'organization' => [
                'string',
                'min:1',
                'max:100',
                'required',
            ],
            'participant_type' => [
                'required',
            ],
            'study_level_id' => [
                'required',
                'integer',
            ],
            'extra_field' => [
                'string',
                'nullable',
            ],
        ];
    }
}
