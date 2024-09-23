<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEmailRequest;
use App\Http\Requests\StoreEmailRequest;
use App\Http\Requests\UpdateEmailRequest;
use App\Models\BootcampParticipant;
use App\Models\Email;
use App\Models\QrCode;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EmailsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('email_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Email::with(['qrcode', 'bootcamp_participant_email', 'created_by'])->select(sprintf('%s.*', (new Email)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'email_show';
                $editGate      = 'email_edit';
                $deleteGate    = 'email_delete';
                $crudRoutePart = 'emails';

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
            $table->addColumn('qrcode_qr_code_value', function ($row) {
                return $row->qrcode ? $row->qrcode->qr_code_value : '';
            });

            $table->editColumn('status', function ($row) {
//                return $row->status ? Email::STATUS_SELECT[$row->status] : '';
                return Email::STATUS_SELECT[$row->status];
            });
            $table->addColumn('bootcamp_participant_email_email', function ($row) {
                return $row->bootcamp_participant_email ? $row->bootcamp_participant_email->email : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'qrcode', 'bootcamp_participant_email']);

            return $table->make(true);
        }

        $qr_codes              = QrCode::get();
        $bootcamp_participants = BootcampParticipant::get();
        $users                 = User::get();

        return view('admin.emails.index', compact('qr_codes', 'bootcamp_participants', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('email_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qrcodes = QrCode::pluck('qr_code_value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bootcamp_participant_emails = BootcampParticipant::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.emails.create', compact('bootcamp_participant_emails', 'qrcodes'));
    }

    public function store(StoreEmailRequest $request)
    {
        $email = Email::create($request->all());

        return redirect()->route('admin.emails.index');
    }

    public function edit(Email $email)
    {
        abort_if(Gate::denies('email_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qrcodes = QrCode::pluck('qr_code_value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bootcamp_participant_emails = BootcampParticipant::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $email->load('qrcode', 'bootcamp_participant_email', 'created_by');

        return view('admin.emails.edit', compact('bootcamp_participant_emails', 'email', 'qrcodes'));
    }

    public function update(UpdateEmailRequest $request, Email $email)
    {
        $email->update($request->all());

        return redirect()->route('admin.emails.index');
    }

    public function show(Email $email)
    {
        abort_if(Gate::denies('email_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $email->load('qrcode', 'bootcamp_participant_email', 'created_by');

        return view('admin.emails.show', compact('email'));
    }

    public function destroy(Email $email)
    {
        abort_if(Gate::denies('email_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $email->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmailRequest $request)
    {
        $emails = Email::find(request('ids'));

        foreach ($emails as $email) {
            $email->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
