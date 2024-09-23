<?php

namespace App\Http\Requests;

use App\Models\HEventManagement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHEventManagementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('h_event_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:h_event_managements,id',
        ];
    }
}
