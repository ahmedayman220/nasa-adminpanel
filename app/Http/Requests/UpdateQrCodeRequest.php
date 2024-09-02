<?php

namespace App\Http\Requests;

use App\Models\QrCode;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateQrCodeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('qr_code_edit');
    }

    public function rules()
    {
        return [
            'bootcamp_participant_id' => [
                'required',
                'integer',
            ],
            'qr_code_value' => [
                'string',
                'required',
            ],
        ];
    }
}
