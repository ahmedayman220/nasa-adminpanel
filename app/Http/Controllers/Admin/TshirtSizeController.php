<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTshirtSizeRequest;
use App\Http\Requests\StoreTshirtSizeRequest;
use App\Http\Requests\UpdateTshirtSizeRequest;
use App\Models\TshirtSize;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TshirtSizeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('tshirt_size_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TshirtSize::with(['created_by'])->select(sprintf('%s.*', (new TshirtSize)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'tshirt_size_show';
                $editGate      = 'tshirt_size_edit';
                $deleteGate    = 'tshirt_size_delete';
                $crudRoutePart = 'tshirt-sizes';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('extra_field', function ($row) {
                return $row->extra_field ? $row->extra_field : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.tshirtSizes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tshirt_size_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tshirtSizes.create');
    }

    public function store(StoreTshirtSizeRequest $request)
    {
        $tshirtSize = TshirtSize::create($request->all());

        return redirect()->route('admin.tshirt-sizes.index');
    }

    public function edit(TshirtSize $tshirtSize)
    {
        abort_if(Gate::denies('tshirt_size_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tshirtSize->load('created_by');

        return view('admin.tshirtSizes.edit', compact('tshirtSize'));
    }

    public function update(UpdateTshirtSizeRequest $request, TshirtSize $tshirtSize)
    {
        $tshirtSize->update($request->all());

        return redirect()->route('admin.tshirt-sizes.index');
    }

    public function show(TshirtSize $tshirtSize)
    {
        abort_if(Gate::denies('tshirt_size_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tshirtSize->load('created_by', 'tshirtSizeMembers');

        return view('admin.tshirtSizes.show', compact('tshirtSize'));
    }

    public function destroy(TshirtSize $tshirtSize)
    {
        abort_if(Gate::denies('tshirt_size_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tshirtSize->delete();

        return back();
    }

    public function massDestroy(MassDestroyTshirtSizeRequest $request)
    {
        $tshirtSizes = TshirtSize::find(request('ids'));

        foreach ($tshirtSizes as $tshirtSize) {
            $tshirtSize->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
