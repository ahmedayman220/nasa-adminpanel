<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyParticipantWorkshopAssignmentRequest;
use App\Http\Requests\StoreParticipantWorkshopAssignmentRequest;
use App\Http\Requests\UpdateParticipantWorkshopAssignmentRequest;
use App\Models\BootcampParticipant;
use App\Models\ParticipantWorkshopAssignment;
use App\Models\User;
use App\Models\WorkshopSchedule;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ParticipantWorkshopAssignmentController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('participant_workshop_assignment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ParticipantWorkshopAssignment::with(['bootcamp_participant', 'workshop_schedule', 'created_by'])->select(sprintf('%s.*', (new ParticipantWorkshopAssignment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'participant_workshop_assignment_show';
                $editGate      = 'participant_workshop_assignment_edit';
                $deleteGate    = 'participant_workshop_assignment_delete';
                $crudRoutePart = 'participant-workshop-assignments';

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
            $table->addColumn('bootcamp_participant_name_en', function ($row) {
                return $row->bootcamp_participant ? $row->bootcamp_participant->name_en : '';
            });

            $table->addColumn('workshop', function ($row) {
                return $row->workshop ? $row : '';
            });

            $table->addColumn('workshop_schedule_schedule_time', function ($row) {
                return $row->workshop_schedule ? $row->workshop_schedule->workshop->title . '[' . $row->workshop_schedule->schedule_time . ']': '';
            });

            $table->editColumn('attendance_status', function ($row) {
                return $row->attendance_status ? ParticipantWorkshopAssignment::ATTENDANCE_STATUS_SELECT[$row->attendance_status] : '';
            });
            $table->editColumn('check_in_time', function ($row) {
                return $row->check_in_time ? $row->check_in_time : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'bootcamp_participant', 'workshop_schedule']);

            return $table->make(true);
        }

        $bootcamp_participants = BootcampParticipant::get();
        $workshop_schedules    = WorkshopSchedule::get();
        $users                 = User::get();

        return view('admin.participantWorkshopAssignments.index', compact('bootcamp_participants', 'workshop_schedules', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('participant_workshop_assignment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcamp_participants = BootcampParticipant::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workshop_schedules = WorkshopSchedule::pluck('schedule_time', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.participantWorkshopAssignments.create', compact('bootcamp_participants', 'workshop_schedules'));
    }

    public function store(StoreParticipantWorkshopAssignmentRequest $request)
    {
        $participantWorkshopAssignment = ParticipantWorkshopAssignment::create($request->all());

        return redirect()->route('admin.participant-workshop-assignments.index');
    }

    public function edit(ParticipantWorkshopAssignment $participantWorkshopAssignment)
    {
        abort_if(Gate::denies('participant_workshop_assignment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcamp_participants = BootcampParticipant::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workshop_schedules = WorkshopSchedule::pluck('schedule_time', 'id')->prepend(trans('global.pleaseSelect'), '');

        $participantWorkshopAssignment->load('bootcamp_participant', 'workshop_schedule', 'created_by');

        return view('admin.participantWorkshopAssignments.edit', compact('bootcamp_participants', 'participantWorkshopAssignment', 'workshop_schedules'));
    }

    public function update(UpdateParticipantWorkshopAssignmentRequest $request, ParticipantWorkshopAssignment $participantWorkshopAssignment)
    {
        $participantWorkshopAssignment->update($request->all());

        return redirect()->route('admin.participant-workshop-assignments.index');
    }

    public function show(ParticipantWorkshopAssignment $participantWorkshopAssignment)
    {
        abort_if(Gate::denies('participant_workshop_assignment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participantWorkshopAssignment->load('bootcamp_participant', 'workshop_schedule', 'created_by');

        return view('admin.participantWorkshopAssignments.show', compact('participantWorkshopAssignment'));
    }

    public function destroy(ParticipantWorkshopAssignment $participantWorkshopAssignment)
    {
        abort_if(Gate::denies('participant_workshop_assignment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participantWorkshopAssignment->delete();

        return back();
    }

    public function massDestroy(MassDestroyParticipantWorkshopAssignmentRequest $request)
    {
        $participantWorkshopAssignments = ParticipantWorkshopAssignment::find(request('ids'));

        foreach ($participantWorkshopAssignments as $participantWorkshopAssignment) {
            $participantWorkshopAssignment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
