<?php

namespace App\Http\Requests;

use App\Models\ParticipationMethod;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyParticipationMethodRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('participation_method_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:participation_methods,id',
        ];
    }
}
