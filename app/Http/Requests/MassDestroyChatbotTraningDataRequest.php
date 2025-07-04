<?php

namespace App\Http\Requests;

use App\Models\ChatbotTraningData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyChatbotTraningDataRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('chatbot_traning_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:chatbot_traning_datas,id',
        ];
    }
}
