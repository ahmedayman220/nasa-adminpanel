<?php

namespace App\Http\Requests;

use App\Models\Evaluation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEvaluationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('evaluation_create');
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
