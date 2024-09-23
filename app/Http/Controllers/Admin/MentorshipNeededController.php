<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMentorshipNeededRequest;
use App\Http\Requests\StoreMentorshipNeededRequest;
use App\Http\Requests\UpdateMentorshipNeededRequest;
use App\Models\MentorshipNeeded;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MentorshipNeededController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('mentorship_needed_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MentorshipNeeded::with(['created_by'])->select(sprintf('%s.*', (new MentorshipNeeded)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'mentorship_needed_show';
                $editGate      = 'mentorship_needed_edit';
                $deleteGate    = 'mentorship_needed_delete';
                $crudRoutePart = 'mentorship-neededs';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('extra_field', function ($row) {
                return $row->extra_field ? $row->extra_field : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.mentorshipNeededs.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('mentorship_needed_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mentorshipNeededs.create');
    }

    public function store(StoreMentorshipNeededRequest $request)
    {
        $mentorshipNeeded = MentorshipNeeded::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $mentorshipNeeded->id]);
        }

        return redirect()->route('admin.mentorship-neededs.index');
    }

    public function edit(MentorshipNeeded $mentorshipNeeded)
    {
        abort_if(Gate::denies('mentorship_needed_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mentorshipNeeded->load('created_by');

        return view('admin.mentorshipNeededs.edit', compact('mentorshipNeeded'));
    }

    public function update(UpdateMentorshipNeededRequest $request, MentorshipNeeded $mentorshipNeeded)
    {
        $mentorshipNeeded->update($request->all());

        return redirect()->route('admin.mentorship-neededs.index');
    }

    public function show(MentorshipNeeded $mentorshipNeeded)
    {
        abort_if(Gate::denies('mentorship_needed_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mentorshipNeeded->load('created_by', 'mentorshipNeededTeams');

        return view('admin.mentorshipNeededs.show', compact('mentorshipNeeded'));
    }

    public function destroy(MentorshipNeeded $mentorshipNeeded)
    {
        abort_if(Gate::denies('mentorship_needed_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mentorshipNeeded->delete();

        return back();
    }

    public function massDestroy(MassDestroyMentorshipNeededRequest $request)
    {
        $mentorshipNeededs = MentorshipNeeded::find(request('ids'));

        foreach ($mentorshipNeededs as $mentorshipNeeded) {
            $mentorshipNeeded->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('mentorship_needed_create') && Gate::denies('mentorship_needed_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MentorshipNeeded();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
