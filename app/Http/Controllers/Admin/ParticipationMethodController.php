<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyParticipationMethodRequest;
use App\Http\Requests\StoreParticipationMethodRequest;
use App\Http\Requests\UpdateParticipationMethodRequest;
use App\Models\ParticipationMethod;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ParticipationMethodController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('participation_method_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ParticipationMethod::with(['created_by'])->select(sprintf('%s.*', (new ParticipationMethod)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'participation_method_show';
                $editGate      = 'participation_method_edit';
                $deleteGate    = 'participation_method_delete';
                $crudRoutePart = 'participation-methods';

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

        return view('admin.participationMethods.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('participation_method_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.participationMethods.create');
    }

    public function store(StoreParticipationMethodRequest $request)
    {
        $participationMethod = ParticipationMethod::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $participationMethod->id]);
        }

        return redirect()->route('admin.participation-methods.index');
    }

    public function edit(ParticipationMethod $participationMethod)
    {
        abort_if(Gate::denies('participation_method_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participationMethod->load('created_by');

        return view('admin.participationMethods.edit', compact('participationMethod'));
    }

    public function update(UpdateParticipationMethodRequest $request, ParticipationMethod $participationMethod)
    {
        $participationMethod->update($request->all());

        return redirect()->route('admin.participation-methods.index');
    }

    public function show(ParticipationMethod $participationMethod)
    {
        abort_if(Gate::denies('participation_method_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participationMethod->load('created_by', 'participationMethodTeams');

        return view('admin.participationMethods.show', compact('participationMethod'));
    }

    public function destroy(ParticipationMethod $participationMethod)
    {
        abort_if(Gate::denies('participation_method_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participationMethod->delete();

        return back();
    }

    public function massDestroy(MassDestroyParticipationMethodRequest $request)
    {
        $participationMethods = ParticipationMethod::find(request('ids'));

        foreach ($participationMethods as $participationMethod) {
            $participationMethod->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('participation_method_create') && Gate::denies('participation_method_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ParticipationMethod();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
