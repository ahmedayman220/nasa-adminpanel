<?php

namespace App\Http\Requests;

use App\Models\ChatbotTraningData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreChatbotTraningDataRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('chatbot_traning_data_create');
    }

    public function rules()
    {
        return [
            'question' => [
                'required',
            ],
            'answer' => [
                'required',
            ],
        ];
    }
}
