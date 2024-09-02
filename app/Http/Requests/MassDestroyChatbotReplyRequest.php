<?php

namespace App\Http\Requests;

use App\Models\ChatbotReply;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyChatbotReplyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('chatbot_reply_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:chatbot_replies,id',
        ];
    }
}
