<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreChatbotReplyRequest;
use App\Http\Requests\UpdateChatbotReplyRequest;
use App\Http\Resources\Admin\ChatbotReplyResource;
use App\Models\ChatbotReply;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChatbotRepliesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        $acceptedReplies = ChatbotReply::where('status', 'accepted')->get();

        return new ChatbotReplyResource($acceptedReplies);
    }

    public function store(StoreChatbotReplyRequest $request)
    {
        $chatbotReply = ChatbotReply::create($request->all());

        return (new ChatbotReplyResource($chatbotReply))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ChatbotReply $chatbotReply)
    {
        abort_if(Gate::denies('chatbot_reply_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChatbotReplyResource($chatbotReply->load(['created_by']));
    }

    public function update(UpdateChatbotReplyRequest $request, ChatbotReply $chatbotReply)
    {
        $chatbotReply->update($request->all());

        return (new ChatbotReplyResource($chatbotReply))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ChatbotReply $chatbotReply)
    {
        abort_if(Gate::denies('chatbot_reply_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chatbotReply->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
