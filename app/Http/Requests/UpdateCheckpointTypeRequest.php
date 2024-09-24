<?php

namespace App\Http\Requests;

use App\Models\CheckpointType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCheckpointTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('checkpoint_type_edit');
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
