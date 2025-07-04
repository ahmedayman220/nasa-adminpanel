<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyQrCodeRequest;
use App\Http\Requests\StoreQrCodeRequest;
use App\Http\Requests\UpdateQrCodeRequest;
use App\Models\BootcampParticipant;
use App\Models\QrCode;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class QrCodesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('qr_code_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = QrCode::with(['bootcamp_participant', 'created_by'])->select(sprintf('%s.*', (new QrCode)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'qr_code_show';
                $editGate      = 'qr_code_edit';
                $deleteGate    = 'qr_code_delete';
                $crudRoutePart = 'qr-codes';

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
            $table->addColumn('bootcamp_participant_name_en', function ($row) {
                return $row->bootcamp_participant ? $row->bootcamp_participant->name_en : '';
            });

            $table->editColumn('qr_code_value', function ($row) {
                return $row->qr_code_value ? $row->qr_code_value : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? QrCode::STATUS_RADIO[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'bootcamp_participant']);

            return $table->make(true);
        }

        $bootcamp_participants = BootcampParticipant::get();
        $users                 = User::get();

        return view('admin.qrCodes.index', compact('bootcamp_participants', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('qr_code_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcamp_participants = BootcampParticipant::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.qrCodes.create', compact('bootcamp_participants'));
    }

    public function store(StoreQrCodeRequest $request)
    {
        $qrCode = QrCode::create($request->all());

        return redirect()->route('admin.qr-codes.index');
    }

    public function edit(QrCode $qrCode)
    {
        abort_if(Gate::denies('qr_code_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcamp_participants = BootcampParticipant::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $qrCode->load('bootcamp_participant', 'created_by');

        return view('admin.qrCodes.edit', compact('bootcamp_participants', 'qrCode'));
    }

    public function update(UpdateQrCodeRequest $request, QrCode $qrCode)
    {
        $qrCode->update($request->all());

        return redirect()->route('admin.qr-codes.index');
    }

    public function show(QrCode $qrCode)
    {
        abort_if(Gate::denies('qr_code_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qrCode->load('bootcamp_participant', 'created_by', 'qrcodeEmails', 'qrCodeMembers');

        return view('admin.qrCodes.show', compact('qrCode'));
    }

    public function destroy(QrCode $qrCode)
    {
        abort_if(Gate::denies('qr_code_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qrCode->delete();

        return back();
    }

    public function massDestroy(MassDestroyQrCodeRequest $request)
    {
        $qrCodes = QrCode::find(request('ids'));

        foreach ($qrCodes as $qrCode) {
            $qrCode->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
