<?php

namespace App\Http\Requests;

use App\Models\WorkshopSchedule;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWorkshopScheduleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('workshop_schedule_create');
    }

    public function rules()
    {
        return [
            'workshop_id' => [
                'required',
                'integer',
            ],
            'schedule_time' => [
                'string',
                'required',
            ],
            'capacity' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
