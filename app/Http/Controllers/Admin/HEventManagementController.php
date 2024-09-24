<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyHEventManagementRequest;
use App\Http\Requests\StoreHEventManagementRequest;
use App\Http\Requests\UpdateHEventManagementRequest;
use App\Models\HEventManagement;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HEventManagementController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('h_event_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HEventManagement::with(['created_by'])->select(sprintf('%s.*', (new HEventManagement)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'h_event_management_show';
                $editGate      = 'h_event_management_edit';
                $deleteGate    = 'h_event_management_delete';
                $crudRoutePart = 'h-event-managements';

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
            $table->editColumn('test', function ($row) {
                return $row->test ? $row->test : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.hEventManagements.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('h_event_management_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.hEventManagements.create');
    }

    public function store(StoreHEventManagementRequest $request)
    {
        $hEventManagement = HEventManagement::create($request->all());

        return redirect()->route('admin.h-event-managements.index');
    }

    public function edit(HEventManagement $hEventManagement)
    {
        abort_if(Gate::denies('h_event_management_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hEventManagement->load('created_by');

        return view('admin.hEventManagements.edit', compact('hEventManagement'));
    }

    public function update(UpdateHEventManagementRequest $request, HEventManagement $hEventManagement)
    {
        $hEventManagement->update($request->all());

        return redirect()->route('admin.h-event-managements.index');
    }

    public function show(HEventManagement $hEventManagement)
    {
        abort_if(Gate::denies('h_event_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hEventManagement->load('created_by');

        return view('admin.hEventManagements.show', compact('hEventManagement'));
    }

    public function destroy(HEventManagement $hEventManagement)
    {
        abort_if(Gate::denies('h_event_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hEventManagement->delete();

        return back();
    }

    public function massDestroy(MassDestroyHEventManagementRequest $request)
    {
        $hEventManagements = HEventManagement::find(request('ids'));

        foreach ($hEventManagements as $hEventManagement) {
            $hEventManagement->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
