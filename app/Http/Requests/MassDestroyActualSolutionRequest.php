<?php

namespace App\Http\Requests;

use App\Models\ActualSolution;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyActualSolutionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('actual_solution_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:actual_solutions,id',
        ];
    }
}
