<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStudyLevelssRequest;
use App\Http\Requests\StoreStudyLevelssRequest;
use App\Http\Requests\UpdateStudyLevelssRequest;
use App\Models\StudyLevelss;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudyLevelssController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('study_levelss_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StudyLevelss::with(['created_by'])->select(sprintf('%s.*', (new StudyLevelss)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'study_levelss_show';
                $editGate      = 'study_levelss_edit';
                $deleteGate    = 'study_levelss_delete';
                $crudRoutePart = 'study-levelsses';

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

        return view('admin.studyLevelsses.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('study_levelss_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.studyLevelsses.create');
    }

    public function store(StoreStudyLevelssRequest $request)
    {
        $studyLevelss = StudyLevelss::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $studyLevelss->id]);
        }

        return redirect()->route('admin.study-levelsses.index');
    }

    public function edit(StudyLevelss $studyLevelss)
    {
        abort_if(Gate::denies('study_levelss_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studyLevelss->load('created_by');

        return view('admin.studyLevelsses.edit', compact('studyLevelss'));
    }

    public function update(UpdateStudyLevelssRequest $request, StudyLevelss $studyLevelss)
    {
        $studyLevelss->update($request->all());

        return redirect()->route('admin.study-levelsses.index');
    }

    public function show(StudyLevelss $studyLevelss)
    {
        abort_if(Gate::denies('study_levelss_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studyLevelss->load('created_by', 'studyLevelMembers');

        return view('admin.studyLevelsses.show', compact('studyLevelss'));
    }

    public function destroy(StudyLevelss $studyLevelss)
    {
        abort_if(Gate::denies('study_levelss_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studyLevelss->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudyLevelssRequest $request)
    {
        $studyLevelsses = StudyLevelss::find(request('ids'));

        foreach ($studyLevelsses as $studyLevelss) {
            $studyLevelss->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('study_levelss_create') && Gate::denies('study_levelss_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new StudyLevelss();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
