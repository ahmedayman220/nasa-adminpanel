<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyWorkshopScheduleRequest;
use App\Http\Requests\StoreWorkshopScheduleRequest;
use App\Http\Requests\UpdateWorkshopScheduleRequest;
use App\Models\User;
use App\Models\Workshop;
use App\Models\WorkshopSchedule;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WorkshopSchedulesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('workshop_schedule_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WorkshopSchedule::with(['workshop', 'created_by'])->select(sprintf('%s.*', (new WorkshopSchedule)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'workshop_schedule_show';
                $editGate      = 'workshop_schedule_edit';
                $deleteGate    = 'workshop_schedule_delete';
                $crudRoutePart = 'workshop-schedules';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                // Get current page and page length from the request
                $start = request()->input('start', 0);

                // Increment the index based on current page
                static $index = 0;
                return ++$index + $start;
            });
            $table->addColumn('workshop_title', function ($row) {
                return $row->workshop ? $row->workshop->title : '';
            });

            $table->editColumn('schedule_time', function ($row) {
                return $row->schedule_time ? $row->schedule_time : '';
            });
            $table->editColumn('capacity', function ($row) {
                return $row->capacity ? $row->capacity : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'workshop']);

            return $table->make(true);
        }

        $workshops = Workshop::get();
        $users     = User::get();

        return view('admin.workshopSchedules.index', compact('workshops', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('workshop_schedule_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workshops = Workshop::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.workshopSchedules.create', compact('workshops'));
    }

    public function store(StoreWorkshopScheduleRequest $request)
    {
        $workshopSchedule = WorkshopSchedule::create($request->all());

        return redirect()->route('admin.workshop-schedules.index');
    }

    public function edit(WorkshopSchedule $workshopSchedule)
    {
        abort_if(Gate::denies('workshop_schedule_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workshops = Workshop::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workshopSchedule->load('workshop', 'created_by');

        return view('admin.workshopSchedules.edit', compact('workshopSchedule', 'workshops'));
    }

    public function update(UpdateWorkshopScheduleRequest $request, WorkshopSchedule $workshopSchedule)
    {
        $workshopSchedule->update($request->all());

        return redirect()->route('admin.workshop-schedules.index');
    }

    public function show(WorkshopSchedule $workshopSchedule)
    {
        abort_if(Gate::denies('workshop_schedule_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workshopSchedule->load('workshop', 'created_by', 'workshopScheduleParticipantWorkshopAssignments');

        return view('admin.workshopSchedules.show', compact('workshopSchedule'));
    }

    public function destroy(WorkshopSchedule $workshopSchedule)
    {
        abort_if(Gate::denies('workshop_schedule_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workshopSchedule->delete();

        return back();
    }

    public function massDestroy(MassDestroyWorkshopScheduleRequest $request)
    {
        $workshopSchedules = WorkshopSchedule::find(request('ids'));

        foreach ($workshopSchedules as $workshopSchedule) {
            $workshopSchedule->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
