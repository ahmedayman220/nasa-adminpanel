<?php

namespace App\Http\Requests;

use App\Models\CheckpointType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCheckpointTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('checkpoint_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
