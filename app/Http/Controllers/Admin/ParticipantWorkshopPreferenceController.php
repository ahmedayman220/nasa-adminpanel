<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyParticipantWorkshopPreferenceRequest;
use App\Http\Requests\StoreParticipantWorkshopPreferenceRequest;
use App\Http\Requests\UpdateParticipantWorkshopPreferenceRequest;
use App\Models\BootcampParticipant;
use App\Models\ParticipantWorkshopPreference;
use App\Models\User;
use App\Models\Workshop;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ParticipantWorkshopPreferenceController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('participant_workshop_preference_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ParticipantWorkshopPreference::with(['bootcamp_participant', 'workshop', 'created_by'])->select(sprintf('%s.*', (new ParticipantWorkshopPreference)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'participant_workshop_preference_show';
                $editGate      = 'participant_workshop_preference_edit';
                $deleteGate    = 'participant_workshop_preference_delete';
                $crudRoutePart = 'participant-workshop-preferences';

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
                return $row->workshop ? $row->workshop->title : '';
            });

            $table->editColumn('preference_order', function ($row) {
                return $row->preference_order ? ParticipantWorkshopPreference::PREFERENCE_ORDER_SELECT[$row->preference_order] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'bootcamp_participant', 'workshop']);

            return $table->make(true);
        }

        $bootcamp_participants = BootcampParticipant::get();
        $workshops             = Workshop::get();
        $users                 = User::get();

        return view('admin.participantWorkshopPreferences.index', compact('bootcamp_participants', 'workshops', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('participant_workshop_preference_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcamp_participants = BootcampParticipant::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workshops = Workshop::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.participantWorkshopPreferences.create', compact('bootcamp_participants', 'workshops'));
    }

    public function store(StoreParticipantWorkshopPreferenceRequest $request)
    {
        $participantWorkshopPreference = ParticipantWorkshopPreference::create($request->all());

        return redirect()->route('admin.participant-workshop-preferences.index');
    }

    public function edit(ParticipantWorkshopPreference $participantWorkshopPreference)
    {
        abort_if(Gate::denies('participant_workshop_preference_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcamp_participants = BootcampParticipant::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workshops = Workshop::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $participantWorkshopPreference->load('bootcamp_participant', 'workshop', 'created_by');

        return view('admin.participantWorkshopPreferences.edit', compact('bootcamp_participants', 'participantWorkshopPreference', 'workshops'));
    }

    public function update(UpdateParticipantWorkshopPreferenceRequest $request, ParticipantWorkshopPreference $participantWorkshopPreference)
    {
        $participantWorkshopPreference->update($request->all());

        return redirect()->route('admin.participant-workshop-preferences.index');
    }

    public function show(ParticipantWorkshopPreference $participantWorkshopPreference)
    {
        abort_if(Gate::denies('participant_workshop_preference_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participantWorkshopPreference->load('bootcamp_participant', 'workshop', 'created_by');

        return view('admin.participantWorkshopPreferences.show', compact('participantWorkshopPreference'));
    }

    public function destroy(ParticipantWorkshopPreference $participantWorkshopPreference)
    {
        abort_if(Gate::denies('participant_workshop_preference_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participantWorkshopPreference->delete();

        return back();
    }

    public function massDestroy(MassDestroyParticipantWorkshopPreferenceRequest $request)
    {
        $participantWorkshopPreferences = ParticipantWorkshopPreference::find(request('ids'));

        foreach ($participantWorkshopPreferences as $participantWorkshopPreference) {
            $participantWorkshopPreference->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
