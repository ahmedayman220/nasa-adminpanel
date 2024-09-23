<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCheckpointRequest;
use App\Http\Requests\StoreCheckpointRequest;
use App\Http\Requests\UpdateCheckpointRequest;
use App\Models\Checkpoint;
use App\Models\CheckpointType;
use App\Models\Event;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CheckpointsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('checkpoint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Checkpoint::with(['event', 'checkpoint_type', 'created_by'])->select(sprintf('%s.*', (new Checkpoint)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'checkpoint_show';
                $editGate      = 'checkpoint_edit';
                $deleteGate    = 'checkpoint_delete';
                $crudRoutePart = 'checkpoints';

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
            $table->addColumn('event_name', function ($row) {
                return $row->event ? $row->event->name : '';
            });

            $table->addColumn('checkpoint_type_name', function ($row) {
                return $row->checkpoint_type ? $row->checkpoint_type->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'event', 'checkpoint_type']);

            return $table->make(true);
        }

        $events           = Event::get();
        $checkpoint_types = CheckpointType::get();
        $users            = User::get();

        return view('admin.checkpoints.index', compact('events', 'checkpoint_types', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('checkpoint_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $checkpoint_types = CheckpointType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.checkpoints.create', compact('checkpoint_types', 'events'));
    }

    public function store(StoreCheckpointRequest $request)
    {
        $checkpoint = Checkpoint::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $checkpoint->id]);
        }

        return redirect()->route('admin.checkpoints.index');
    }

    public function edit(Checkpoint $checkpoint)
    {
        abort_if(Gate::denies('checkpoint_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $checkpoint_types = CheckpointType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $checkpoint->load('event', 'checkpoint_type', 'created_by');

        return view('admin.checkpoints.edit', compact('checkpoint', 'checkpoint_types', 'events'));
    }

    public function update(UpdateCheckpointRequest $request, Checkpoint $checkpoint)
    {
        $checkpoint->update($request->all());

        return redirect()->route('admin.checkpoints.index');
    }

    public function show(Checkpoint $checkpoint)
    {
        abort_if(Gate::denies('checkpoint_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpoint->load('event', 'checkpoint_type', 'created_by', 'checkpointMemberCheckpoints');

        return view('admin.checkpoints.show', compact('checkpoint'));
    }

    public function destroy(Checkpoint $checkpoint)
    {
        abort_if(Gate::denies('checkpoint_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpoint->delete();

        return back();
    }

    public function massDestroy(MassDestroyCheckpointRequest $request)
    {
        $checkpoints = Checkpoint::find(request('ids'));

        foreach ($checkpoints as $checkpoint) {
            $checkpoint->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('checkpoint_create') && Gate::denies('checkpoint_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Checkpoint();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
