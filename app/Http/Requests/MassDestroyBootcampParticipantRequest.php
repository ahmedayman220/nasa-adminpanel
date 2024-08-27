<?php

namespace App\Http\Requests;

use App\Models\BootcampParticipant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBootcampParticipantRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bootcamp_participant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bootcamp_participants,id',
        ];
    }
}
