<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyChatbotTraningDataRequest;
use App\Http\Requests\StoreChatbotTraningDataRequest;
use App\Http\Requests\UpdateChatbotTraningDataRequest;
use App\Models\ChatbotTraningData;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ChatbotTraningDataController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('chatbot_traning_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ChatbotTraningData::with(['created_by'])->select(sprintf('%s.*', (new ChatbotTraningData)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'chatbot_traning_data_show';
                $editGate      = 'chatbot_traning_data_edit';
                $deleteGate    = 'chatbot_traning_data_delete';
                $crudRoutePart = 'chatbot-traning-datas';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('question', function ($row) {
                return $row->question ? $row->question : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.chatbotTraningDatas.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('chatbot_traning_data_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.chatbotTraningDatas.create');
    }

    public function store(StoreChatbotTraningDataRequest $request)
    {
        $chatbotTraningData = ChatbotTraningData::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $chatbotTraningData->id]);
        }

        return redirect()->route('admin.chatbot-traning-datas.index');
    }

    public function edit(ChatbotTraningData $chatbotTraningData)
    {
        abort_if(Gate::denies('chatbot_traning_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chatbotTraningData->load('created_by');

        return view('admin.chatbotTraningDatas.edit', compact('chatbotTraningData'));
    }

    public function update(UpdateChatbotTraningDataRequest $request, ChatbotTraningData $chatbotTraningData)
    {
        $chatbotTraningData->update($request->all());

        return redirect()->route('admin.chatbot-traning-datas.index');
    }

    public function show(ChatbotTraningData $chatbotTraningData)
    {
        abort_if(Gate::denies('chatbot_traning_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chatbotTraningData->load('created_by');

        return view('admin.chatbotTraningDatas.show', compact('chatbotTraningData'));
    }

    public function destroy(ChatbotTraningData $chatbotTraningData)
    {
        abort_if(Gate::denies('chatbot_traning_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $chatbotTraningData->delete();

        return back();
    }

    public function massDestroy(MassDestroyChatbotTraningDataRequest $request)
    {
        $chatbotTraningDatas = ChatbotTraningData::find(request('ids'));

        foreach ($chatbotTraningDatas as $chatbotTraningData) {
            $chatbotTraningData->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('chatbot_traning_data_create') && Gate::denies('chatbot_traning_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ChatbotTraningData();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
