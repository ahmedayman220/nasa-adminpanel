<?php

namespace App\Http\Requests;

use App\Models\MentionYourField;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMentionYourFieldRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('mention_your_field_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:mention_your_fields,id',
        ];
    }
}
