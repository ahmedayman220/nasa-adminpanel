<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyChatbotReplyRequest;
use App\Http\Requests\StoreChatbotReplyRequest;
use App\Http\Requests\UpdateChatbotReplyRequest;
use App\Models\ChatbotReply;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ChatbotRepliesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('chatbot_reply_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ChatbotReply::with(['created_by'])->select(sprintf('%s.*', (new ChatbotReply)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'chatbot_reply_show';
                $editGate      = 'chatbot_reply_edit';
                $deleteGate    = 'chatbot_reply_delete';
                $crudRoutePart = 'chatbot-replies';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                // Get current page and page length from the request
                $start = request()->input('start', 0);

                // Increment the index based on current page
                static $index = 0;
                return ++$index + $start;
            });
            $table->editColumn('question', function ($row) {
                return $row->question ? $row->question : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? ChatbotReply::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.chatbotReplies.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('chatbot_reply_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.chatbotReplies.create');
    }

    public function store(StoreChatbotReplyRequest $request)
    {
        $chatbotReply = ChatbotReply::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $chatbotReply->id]);
        }

        return redirect()->route('admin.chatbot-replies.index');
    }

    public function edit(ChatbotReply $chatbotReply)
    {
        abort_if(Gate::denies('chatbot_reply_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chatbotReply->load('created_by');

        return view('admin.chatbotReplies.edit', compact('chatbotReply'));
    }

    public function update(UpdateChatbotReplyRequest $request, ChatbotReply $chatbotReply)
    {
        $chatbotReply->update($request->all());

        return redirect()->route('admin.chatbot-replies.index');
    }

    public function show(ChatbotReply $chatbotReply)
    {
        abort_if(Gate::denies('chatbot_reply_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chatbotReply->load('created_by');

        return view('admin.chatbotReplies.show', compact('chatbotReply'));
    }

    public function destroy(ChatbotReply $chatbotReply)
    {
        abort_if(Gate::denies('chatbot_reply_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chatbotReply->delete();

        return back();
    }

    public function massDestroy(MassDestroyChatbotReplyRequest $request)
    {
        $chatbotReplies = ChatbotReply::find(request('ids'));

        foreach ($chatbotReplies as $chatbotReply) {
            $chatbotReply->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('chatbot_reply_create') && Gate::denies('chatbot_reply_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ChatbotReply();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
