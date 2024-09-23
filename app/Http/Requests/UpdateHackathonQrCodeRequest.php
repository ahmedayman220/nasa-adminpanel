<?php

namespace App\Http\Requests;

use App\Models\HackathonQrCode;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHackathonQrCodeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hackathon_qr_code_edit');
    }

    public function rules()
    {
        return [
            'test' => [
                'string',
                'nullable',
            ],
        ];
    }
}
