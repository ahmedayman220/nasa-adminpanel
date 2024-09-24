<?php

namespace App\Http\Requests;

use App\Models\HEventManagement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHEventManagementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('h_event_management_create');
    }

    public function rules()
    {
        return [
            'test' => [
                'string',
                'nullable',
            ],
        ];
    }
}
