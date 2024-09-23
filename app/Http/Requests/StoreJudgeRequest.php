<?php

namespace App\Http\Requests;

use App\Models\Judge;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJudgeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('judge_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'expertise' => [
                'string',
                'required',
            ],
            'photo' => [
                'required',
            ],
        ];
    }
}
