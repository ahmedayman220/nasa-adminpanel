<?php

namespace App\Http\Requests;

use App\Models\ChallengeCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyChallengeCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('challenge_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:challenge_categories,id',
        ];
    }
}
