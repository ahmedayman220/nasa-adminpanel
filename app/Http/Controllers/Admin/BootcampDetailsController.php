<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBootcampDetailRequest;
use App\Http\Requests\StoreBootcampDetailRequest;
use App\Http\Requests\UpdateBootcampDetailRequest;
use App\Models\BootcampDetail;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BootcampDetailsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bootcamp_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BootcampDetail::with(['created_by'])->select(sprintf('%s.*', (new BootcampDetail)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'bootcamp_detail_show';
                $editGate      = 'bootcamp_detail_edit';
                $deleteGate    = 'bootcamp_detail_delete';
                $crudRoutePart = 'bootcamp-details';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->editColumn('total_capacity', function ($row) {
                return $row->total_capacity ? $row->total_capacity : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.bootcampDetails.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('bootcamp_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bootcampDetails.create');
    }

    public function store(StoreBootcampDetailRequest $request)
    {
        $bootcampDetail = BootcampDetail::create($request->all());

        return redirect()->route('admin.bootcamp-details.index');
    }

    public function edit(BootcampDetail $bootcampDetail)
    {
        abort_if(Gate::denies('bootcamp_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcampDetail->load('created_by');

        return view('admin.bootcampDetails.edit', compact('bootcampDetail'));
    }

    public function update(UpdateBootcampDetailRequest $request, BootcampDetail $bootcampDetail)
    {
        $bootcampDetail->update($request->all());

        return redirect()->route('admin.bootcamp-details.index');
    }

    public function show(BootcampDetail $bootcampDetail)
    {
        abort_if(Gate::denies('bootcamp_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcampDetail->load('created_by', 'bootcampDetailsBootcampAttendees');

        return view('admin.bootcampDetails.show', compact('bootcampDetail'));
    }

    public function destroy(BootcampDetail $bootcampDetail)
    {
        abort_if(Gate::denies('bootcamp_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcampDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyBootcampDetailRequest $request)
    {
        $bootcampDetails = BootcampDetail::find(request('ids'));

        foreach ($bootcampDetails as $bootcampDetail) {
            $bootcampDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
