<?php

namespace App\Http\Requests;

use App\Models\Member;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMemberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('member_edit');
    }

    public function rules()
    {
        return [
            'uuid' => [
                'string',
                'required',
                'unique:members,uuid,' . request()->route('member')->id,
            ],
            'national' => [
                'string',
                'min:3',
                'max:100',
                'required',
                'unique:members,national,' . request()->route('member')->id,
            ],
            'name' => [
                'string',
                'min:3',
                'max:100',
                'required',
            ],
            'email' => [
                'required',
                'unique:members,email,' . request()->route('member')->id,
            ],
            'phone_number' => [
                'string',
                'min:3',
                'max:100',
                'required',
                'unique:members,phone_number,' . request()->route('member')->id,
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
