<?php

namespace App\Http\Requests;

use App\Models\Workshop;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWorkshopRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('workshop_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}
