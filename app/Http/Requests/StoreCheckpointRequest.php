<?php

namespace App\Http\Requests;

use App\Models\Checkpoint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCheckpointRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('checkpoint_create');
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
