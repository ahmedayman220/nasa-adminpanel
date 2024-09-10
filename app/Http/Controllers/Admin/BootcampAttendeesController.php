<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBootcampAttendeeRequest;
use App\Http\Requests\StoreBootcampAttendeeRequest;
use App\Http\Requests\UpdateBootcampAttendeeRequest;
use App\Models\BootcampAttendee;
use App\Models\BootcampDetail;
use App\Models\BootcampParticipant;
use App\Models\User;
use App\Models\Workshop;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BootcampAttendeesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {

        abort_if(Gate::denies('bootcamp_attendee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BootcampAttendee::with([ 'bootcamp_participant', 'created_by'])->select(sprintf('%s.*', (new BootcampAttendee)->table))->where('attendance_status','attended');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'bootcamp_attendee_show';
                $editGate      = 'bootcamp_attendee_edit';
                $deleteGate    = 'bootcamp_attendee_delete';
                $crudRoutePart = 'bootcamp-attendees';

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

            $table->addColumn('workshop_title', function ($row) {
                return $row->bootcamp_participant->bootcampParticipantParticipantWorkshopAssignments->first()->workshop_schedule->workshop->title . '[' . $row->bootcamp_participant->bootcampParticipantParticipantWorkshopAssignments->first()->workshop_schedule->schedule_time . ']' ?? 'Bootcamp Attendee';
            });

            $table->editColumn('category', function ($row) {
                return $row->category ? BootcampAttendee::CATEGORY_RADIO[$row->category] : BootcampAttendee::CATEGORY_RADIO[$row->category];
            });
            $table->editColumn('attendance_status', function ($row) {
                return $row->attendance_status ? BootcampAttendee::ATTENDANCE_STATUS_RADIO[$row->attendance_status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'bootcamp_details', 'bootcamp_participant']);

            return $table->make(true);
        }

        $bootcamp_participants = BootcampParticipant::get();
        $users                 = User::get();
        $workshops = Workshop::get();
        $bootcamp_details = BootcampDetail::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bootcampAttendees.index', compact( 'bootcamp_participants', 'users','workshops','bootcamp_details'));
    }

    public function create()
    {
        abort_if(Gate::denies('bootcamp_attendee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcamp_details = BootcampDetail::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bootcamp_participants = BootcampParticipant::pluck('uuid', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.bootcampAttendees.create', compact('bootcamp_details', 'bootcamp_participants'));
    }

    public function store(StoreBootcampAttendeeRequest $request)
    {
        // Automatically set the bootcamp_details_id as the first record from bootcamp_details
        $firstBootcampDetail = BootcampDetail::first();
        $bootDetailId = $firstBootcampDetail ? $firstBootcampDetail->id : null; // Set first record ID or null if none exists

        // Set attendance_status to 'attended'
        $attendanceStatus = 'attended';

        // Set check_in_time to the current time
        $checkInTime = now(); // Or use Carbon for more customization: Carbon::now()

        // Merge the values into the request data
        $id = $request->bootcamp_participant_id;
        $attendee = BootcampParticipant::find($id);
        if(!$attendee){
            return redirect()->route('admin.bootcamp-attendees.index')->with('Failed','Attendee not found');
        }

        $participantAttendeeRelation = $attendee->bootcampParticipantBootcampAttendees->first();
        if($participantAttendeeRelation->attendance_status == $attendanceStatus){
            return redirect()->route('admin.bootcamp-attendees.index')->with('Failed','Attendee already attended');
        }
        $participantAttendeeRelation->update([
            'attendance_status' => $attendanceStatus,
            'check_in_time' => $checkInTime,
            'bootcamp_details_id' => $bootDetailId
        ]);
        return redirect()->route('admin.bootcamp-attendees.index')->with('Status','Attendee added successfully');
    }
    public function edit(BootcampAttendee $bootcampAttendee)
    {
        abort_if(Gate::denies('bootcamp_attendee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcamp_details = BootcampDetail::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bootcamp_participants = BootcampParticipant::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bootcampAttendee->load('bootcamp_details', 'bootcamp_participant', 'created_by');

        return view('admin.bootcampAttendees.edit', compact('bootcampAttendee', 'bootcamp_details', 'bootcamp_participants'));
    }

    public function update(UpdateBootcampAttendeeRequest $request, BootcampAttendee $bootcampAttendee)
    {
        $bootcampAttendee->update($request->all());

        return redirect()->route('admin.bootcamp-attendees.index');
    }

    public function show(BootcampAttendee $bootcampAttendee)
    {
        abort_if(Gate::denies('bootcamp_attendee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcampAttendee->load('bootcamp_details', 'bootcamp_participant', 'created_by');

        return view('admin.bootcampAttendees.show', compact('bootcampAttendee'));
    }

    public function destroy(BootcampAttendee $bootcampAttendee)
    {
        abort_if(Gate::denies('bootcamp_attendee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcampAttendee->delete();

        return back();
    }

    public function massDestroy(MassDestroyBootcampAttendeeRequest $request)
    {
        $bootcampAttendees = BootcampAttendee::find(request('ids'));

        foreach ($bootcampAttendees as $bootcampAttendee) {
            $bootcampAttendee->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
