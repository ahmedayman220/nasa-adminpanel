<?php

namespace App\Http\Requests;

use App\Models\Checkpoint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCheckpointRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('checkpoint_edit');
    }

    public function rules()
    {
        return [
            'event_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
