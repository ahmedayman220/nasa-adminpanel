<?php

namespace App\Http\Requests;

use App\Models\UserChallenge;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUserChallengeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_challenge_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:user_challenges,id',
        ];
    }
}
