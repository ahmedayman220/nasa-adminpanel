<?php

namespace App\Http\Requests;

use App\Models\ActualSolution;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreActualSolutionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('actual_solution_create');
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
