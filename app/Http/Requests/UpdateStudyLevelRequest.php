<?php

namespace App\Http\Requests;

use App\Models\StudyLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStudyLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('study_level_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}
