<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyJudgeRequest;
use App\Http\Requests\StoreJudgeRequest;
use App\Http\Requests\UpdateJudgeRequest;
use App\Models\Judge;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class JudgesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('judge_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Judge::with(['created_by'])->select(sprintf('%s.*', (new Judge)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'judge_show';
                $editGate      = 'judge_edit';
                $deleteGate    = 'judge_delete';
                $crudRoutePart = 'judges';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('expertise', function ($row) {
                return $row->expertise ? $row->expertise : '';
            });
            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'photo']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.judges.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('judge_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.judges.create');
    }

    public function store(StoreJudgeRequest $request)
    {
        $judge = Judge::create($request->all());

        if ($request->input('photo', false)) {
            $judge->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $judge->id]);
        }

        return redirect()->route('admin.judges.index');
    }

    public function edit(Judge $judge)
    {
        abort_if(Gate::denies('judge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $judge->load('created_by');

        return view('admin.judges.edit', compact('judge'));
    }

    public function update(UpdateJudgeRequest $request, Judge $judge)
    {
        $judge->update($request->all());

        if ($request->input('photo', false)) {
            if (! $judge->photo || $request->input('photo') !== $judge->photo->file_name) {
                if ($judge->photo) {
                    $judge->photo->delete();
                }
                $judge->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($judge->photo) {
            $judge->photo->delete();
        }

        return redirect()->route('admin.judges.index');
    }

    public function show(Judge $judge)
    {
        abort_if(Gate::denies('judge_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $judge->load('created_by', 'judgeEvaluations');

        return view('admin.judges.show', compact('judge'));
    }

    public function destroy(Judge $judge)
    {
        abort_if(Gate::denies('judge_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $judge->delete();

        return back();
    }

    public function massDestroy(MassDestroyJudgeRequest $request)
    {
        $judges = Judge::find(request('ids'));

        foreach ($judges as $judge) {
            $judge->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('judge_create') && Gate::denies('judge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Judge();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
