<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBootcampConfirmationRequest;
use App\Http\Requests\StoreBootcampConfirmationRequest;
use App\Http\Requests\UpdateBootcampConfirmationRequest;
use App\Models\BootcampConfirmation;
use App\Models\BootcampParticipant;
use App\Models\StudyLevel;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BootcampConfirmationController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bootcamp_confirmation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BootcampConfirmation::with(['email', 'national', 'slot', 'created_by'])->select(sprintf('%s.*', (new BootcampConfirmation)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'bootcamp_confirmation_show';
                $editGate      = 'bootcamp_confirmation_edit';
                $deleteGate    = 'bootcamp_confirmation_delete';
                $crudRoutePart = 'bootcamp-confirmations';

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
            $table->addColumn('email_name_en', function ($row) {
                return $row->email ? $row->email->name_en : '';
            });

            $table->addColumn('national_name_en', function ($row) {
                return $row->national ? $row->national->name_en : '';
            });

            $table->editColumn('national.email', function ($row) {
                return $row->national ? (is_string($row->national) ? $row->national : $row->national->email) : '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->addColumn('slot_title', function ($row) {
                return $row->slot ? $row->slot->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'email', 'national', 'slot']);

            return $table->make(true);
        }

        $bootcamp_participants = BootcampParticipant::get();
        $study_levels          = StudyLevel::get();
        $users                 = User::get();

        return view('admin.bootcampConfirmations.index', compact('bootcamp_participants', 'study_levels', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('bootcamp_confirmation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emails = BootcampParticipant::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nationals = BootcampParticipant::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $slots = StudyLevel::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bootcampConfirmations.create', compact('emails', 'nationals', 'slots'));
    }

    public function store(StoreBootcampConfirmationRequest $request)
    {
        $bootcampConfirmation = BootcampConfirmation::create($request->all());

        return redirect()->route('admin.bootcamp-confirmations.index');
    }

    public function edit(BootcampConfirmation $bootcampConfirmation)
    {
        abort_if(Gate::denies('bootcamp_confirmation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emails = BootcampParticipant::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nationals = BootcampParticipant::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $slots = StudyLevel::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bootcampConfirmation->load('email', 'national', 'slot', 'created_by');

        return view('admin.bootcampConfirmations.edit', compact('bootcampConfirmation', 'emails', 'nationals', 'slots'));
    }

    public function update(UpdateBootcampConfirmationRequest $request, BootcampConfirmation $bootcampConfirmation)
    {
        $bootcampConfirmation->update($request->all());

        return redirect()->route('admin.bootcamp-confirmations.index');
    }

    public function show(BootcampConfirmation $bootcampConfirmation)
    {
        abort_if(Gate::denies('bootcamp_confirmation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcampConfirmation->load('email', 'national', 'slot', 'created_by');

        return view('admin.bootcampConfirmations.show', compact('bootcampConfirmation'));
    }

    public function destroy(BootcampConfirmation $bootcampConfirmation)
    {
        abort_if(Gate::denies('bootcamp_confirmation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcampConfirmation->delete();

        return back();
    }

    public function massDestroy(MassDestroyBootcampConfirmationRequest $request)
    {
        $bootcampConfirmations = BootcampConfirmation::find(request('ids'));

        foreach ($bootcampConfirmations as $bootcampConfirmation) {
            $bootcampConfirmation->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
