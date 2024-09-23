<?php

namespace App\Http\Requests;

use App\Models\Evaluation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEvaluationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('evaluation_edit');
    }

    public function rules()
    {
        return [
            'score' => [
                'numeric',
            ],
        ];
    }
}
