<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMajorRequest;
use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdateMajorRequest;
use App\Models\Major;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MajorController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('major_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Major::with(['created_by'])->select(sprintf('%s.*', (new Major)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'major_show';
                $editGate      = 'major_edit';
                $deleteGate    = 'major_delete';
                $crudRoutePart = 'majors';

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

        return view('admin.majors.index');
    }

    public function create()
    {
        abort_if(Gate::denies('major_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.majors.create');
    }

    public function store(StoreMajorRequest $request)
    {
        $major = Major::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $major->id]);
        }

        return redirect()->route('admin.majors.index');
    }

    public function edit(Major $major)
    {
        abort_if(Gate::denies('major_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $major->load('created_by');

        return view('admin.majors.edit', compact('major'));
    }

    public function update(UpdateMajorRequest $request, Major $major)
    {
        $major->update($request->all());

        return redirect()->route('admin.majors.index');
    }

    public function show(Major $major)
    {
        abort_if(Gate::denies('major_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $major->load('created_by', 'majorMembers');

        return view('admin.majors.show', compact('major'));
    }

    public function destroy(Major $major)
    {
        abort_if(Gate::denies('major_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $major->delete();

        return back();
    }

    public function massDestroy(MassDestroyMajorRequest $request)
    {
        $majors = Major::find(request('ids'));

        foreach ($majors as $major) {
            $major->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('major_create') && Gate::denies('major_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Major();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
