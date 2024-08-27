<?php

namespace App\Http\Requests;

use App\Models\BootcampDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBootcampDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bootcamp_detail_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'total_capacity' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
