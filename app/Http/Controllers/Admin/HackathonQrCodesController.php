<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyHackathonQrCodeRequest;
use App\Http\Requests\StoreHackathonQrCodeRequest;
use App\Http\Requests\UpdateHackathonQrCodeRequest;
use App\Models\HackathonQrCode;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HackathonQrCodesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('hackathon_qr_code_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HackathonQrCode::with(['created_by'])->select(sprintf('%s.*', (new HackathonQrCode)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'hackathon_qr_code_show';
                $editGate      = 'hackathon_qr_code_edit';
                $deleteGate    = 'hackathon_qr_code_delete';
                $crudRoutePart = 'hackathon-qr-codes';

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

        return view('admin.hackathonQrCodes.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('hackathon_qr_code_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.hackathonQrCodes.create');
    }

    public function store(StoreHackathonQrCodeRequest $request)
    {
        $hackathonQrCode = HackathonQrCode::create($request->all());

        return redirect()->route('admin.hackathon-qr-codes.index');
    }

    public function edit(HackathonQrCode $hackathonQrCode)
    {
        abort_if(Gate::denies('hackathon_qr_code_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hackathonQrCode->load('created_by');

        return view('admin.hackathonQrCodes.edit', compact('hackathonQrCode'));
    }

    public function update(UpdateHackathonQrCodeRequest $request, HackathonQrCode $hackathonQrCode)
    {
        $hackathonQrCode->update($request->all());

        return redirect()->route('admin.hackathon-qr-codes.index');
    }

    public function show(HackathonQrCode $hackathonQrCode)
    {
        abort_if(Gate::denies('hackathon_qr_code_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hackathonQrCode->load('created_by');

        return view('admin.hackathonQrCodes.show', compact('hackathonQrCode'));
    }

    public function destroy(HackathonQrCode $hackathonQrCode)
    {
        abort_if(Gate::denies('hackathon_qr_code_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hackathonQrCode->delete();

        return back();
    }

    public function massDestroy(MassDestroyHackathonQrCodeRequest $request)
    {
        $hackathonQrCodes = HackathonQrCode::find(request('ids'));

        foreach ($hackathonQrCodes as $hackathonQrCode) {
            $hackathonQrCode->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
