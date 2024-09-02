<?php

namespace App\Http\Requests;

use App\Models\WorkshopSchedule;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWorkshopScheduleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('workshop_schedule_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:workshop_schedules,id',
        ];
    }
}
