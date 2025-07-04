<?php

namespace App\Http\Requests;

use App\Models\EvaluationCriterion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEvaluationCriterionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('evaluation_criterion_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'weight' => [
                'numeric',
                'required',
            ],
        ];
    }
}
