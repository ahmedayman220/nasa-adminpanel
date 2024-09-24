<?php

namespace App\Http\Requests;

use App\Models\EvaluationCriterion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEvaluationCriterionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('evaluation_criterion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:evaluation_criteria,id',
        ];
    }
}
