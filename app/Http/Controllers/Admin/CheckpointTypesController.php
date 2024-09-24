<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCheckpointTypeRequest;
use App\Http\Requests\StoreCheckpointTypeRequest;
use App\Http\Requests\UpdateCheckpointTypeRequest;
use App\Models\CheckpointType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CheckpointTypesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('checkpoint_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CheckpointType::with(['created_by'])->select(sprintf('%s.*', (new CheckpointType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'checkpoint_type_show';
                $editGate      = 'checkpoint_type_edit';
                $deleteGate    = 'checkpoint_type_delete';
                $crudRoutePart = 'checkpoint-types';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.checkpointTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('checkpoint_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.checkpointTypes.create');
    }

    public function store(StoreCheckpointTypeRequest $request)
    {
        $checkpointType = CheckpointType::create($request->all());

        return redirect()->route('admin.checkpoint-types.index');
    }

    public function edit(CheckpointType $checkpointType)
    {
        abort_if(Gate::denies('checkpoint_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpointType->load('created_by');

        return view('admin.checkpointTypes.edit', compact('checkpointType'));
    }

    public function update(UpdateCheckpointTypeRequest $request, CheckpointType $checkpointType)
    {
        $checkpointType->update($request->all());

        return redirect()->route('admin.checkpoint-types.index');
    }

    public function show(CheckpointType $checkpointType)
    {
        abort_if(Gate::denies('checkpoint_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpointType->load('created_by', 'checkpointTypeCheckpoints');

        return view('admin.checkpointTypes.show', compact('checkpointType'));
    }

    public function destroy(CheckpointType $checkpointType)
    {
        abort_if(Gate::denies('checkpoint_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpointType->delete();

        return back();
    }

    public function massDestroy(MassDestroyCheckpointTypeRequest $request)
    {
        $checkpointTypes = CheckpointType::find(request('ids'));

        foreach ($checkpointTypes as $checkpointType) {
            $checkpointType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
