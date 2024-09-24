<?php

namespace App\Http\Requests;

use App\Models\StudyLevelss;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStudyLevelssRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('study_levelss_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:study_levelsses,id',
        ];
    }
}
