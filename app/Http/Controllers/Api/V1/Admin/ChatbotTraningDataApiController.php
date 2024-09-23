<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreChatbotTraningDataRequest;
use App\Http\Requests\UpdateChatbotTraningDataRequest;
use App\Http\Resources\Admin\ChatbotTraningDataResource;
use App\Models\ChatbotTraningData;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChatbotTraningDataApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
//        abort_if(Gate::denies('chatbot_traning_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChatbotTraningDataResource(ChatbotTraningData::get());
    }

    public function store(StoreChatbotTraningDataRequest $request)
    {
        $chatbotTraningData = ChatbotTraningData::create($request->all());

        return (new ChatbotTraningDataResource($chatbotTraningData))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ChatbotTraningData $chatbotTraningData)
    {
        abort_if(Gate::denies('chatbot_traning_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChatbotTraningDataResource($chatbotTraningData->load(['created_by']));
    }

    public function update(UpdateChatbotTraningDataRequest $request, ChatbotTraningData $chatbotTraningData)
    {
        $chatbotTraningData->update($request->all());

        return (new ChatbotTraningDataResource($chatbotTraningData))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ChatbotTraningData $chatbotTraningData)
    {
        abort_if(Gate::denies('chatbot_traning_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chatbotTraningData->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
