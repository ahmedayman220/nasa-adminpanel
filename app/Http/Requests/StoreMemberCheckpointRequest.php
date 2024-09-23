<?php

namespace App\Http\Requests;

use App\Models\MemberCheckpoint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMemberCheckpointRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('member_checkpoint_create');
    }

    public function rules()
    {
        return [
            'member_id' => [
                'required',
                'integer',
            ],
            'checkpoint_id' => [
                'required',
                'integer',
            ],
            'completion_time' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
