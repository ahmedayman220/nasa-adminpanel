<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTransportationRequest;
use App\Http\Requests\StoreTransportationRequest;
use App\Http\Requests\UpdateTransportationRequest;
use App\Models\Transportation;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TransportationController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('transportation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Transportation::with(['created_by'])->select(sprintf('%s.*', (new Transportation)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'transportation_show';
                $editGate      = 'transportation_edit';
                $deleteGate    = 'transportation_delete';
                $crudRoutePart = 'transportations';

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
            $table->editColumn('members_count', function ($row) {
                return $row->transportationMembers->count();
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.transportations.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('transportation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.transportations.create');
    }

    public function store(StoreTransportationRequest $request)
    {
        $transportation = Transportation::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $transportation->id]);
        }

        return redirect()->route('admin.transportations.index');
    }

    public function edit(Transportation $transportation)
    {
        abort_if(Gate::denies('transportation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportation->load('created_by');

        return view('admin.transportations.edit', compact('transportation'));
    }

    public function update(UpdateTransportationRequest $request, Transportation $transportation)
    {
        $transportation->update($request->all());

        return redirect()->route('admin.transportations.index');
    }

    public function show(Transportation $transportation)
    {
        abort_if(Gate::denies('transportation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportation->load('created_by', 'transportationMembers');

        return view('admin.transportations.show', compact('transportation'));
    }

    public function destroy(Transportation $transportation)
    {
        abort_if(Gate::denies('transportation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportation->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransportationRequest $request)
    {
        $transportations = Transportation::find(request('ids'));

        foreach ($transportations as $transportation) {
            $transportation->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('transportation_create') && Gate::denies('transportation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Transportation();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
