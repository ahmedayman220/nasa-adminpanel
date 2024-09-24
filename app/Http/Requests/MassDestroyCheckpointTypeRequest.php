<?php

namespace App\Http\Requests;

use App\Models\CheckpointType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCheckpointTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('checkpoint_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:checkpoint_types,id',
        ];
    }
}
