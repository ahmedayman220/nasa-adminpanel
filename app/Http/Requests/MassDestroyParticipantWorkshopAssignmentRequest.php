<?php

namespace App\Http\Requests;

use App\Models\ParticipantWorkshopAssignment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyParticipantWorkshopAssignmentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('participant_workshop_assignment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:participant_workshop_assignments,id',
        ];
    }
}
