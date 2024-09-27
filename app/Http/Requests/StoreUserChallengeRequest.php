<?php

namespace App\Http\Requests;

use App\Models\UserChallenge;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserChallengeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_challenge_create');
    }

    public function rules()
    {
        return [
            'users.*' => [
                'integer',
            ],
            'users' => [
                'required',
                'array',
            ],
            'challenges.*' => [
                'integer',
            ],
            'challenges' => [
                'required',
                'array',
            ],
        ];
    }
}
