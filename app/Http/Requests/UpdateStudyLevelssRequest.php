<?php

namespace App\Http\Requests;

use App\Models\StudyLevelss;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStudyLevelssRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('study_levelss_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'extra_field' => [
                'string',
                'nullable',
            ],
        ];
    }
}
