<?php

namespace App\Http\Requests;

use App\Models\BootcampDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBootcampDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bootcamp_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bootcamp_details,id',
        ];
    }
}
