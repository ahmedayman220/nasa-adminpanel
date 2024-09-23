<?php

namespace App\Http\Requests;

use App\Models\MemberRole;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMemberRoleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('member_role_edit');
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
