<?php

namespace App\Http\Requests;

use App\Models\MentorshipNeeded;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMentorshipNeededRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('mentorship_needed_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:mentorship_neededs,id',
        ];
    }
}
