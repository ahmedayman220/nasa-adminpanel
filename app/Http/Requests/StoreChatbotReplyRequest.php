<?php

namespace App\Http\Requests;

use App\Models\ChatbotReply;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreChatbotReplyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('chatbot_reply_create');
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
