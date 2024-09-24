<?php

namespace App\Http\Requests;

use App\Models\ActualSolution;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateActualSolutionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('actual_solution_edit');
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
