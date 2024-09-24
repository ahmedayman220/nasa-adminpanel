<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyActualSolutionRequest;
use App\Http\Requests\StoreActualSolutionRequest;
use App\Http\Requests\UpdateActualSolutionRequest;
use App\Models\ActualSolution;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ActualSolutionController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('actual_solution_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ActualSolution::with(['created_by'])->select(sprintf('%s.*', (new ActualSolution)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'actual_solution_show';
                $editGate      = 'actual_solution_edit';
                $deleteGate    = 'actual_solution_delete';
                $crudRoutePart = 'actual-solutions';

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

        return view('admin.actualSolutions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('actual_solution_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.actualSolutions.create');
    }

    public function store(StoreActualSolutionRequest $request)
    {
        $actualSolution = ActualSolution::create($request->all());

        return redirect()->route('admin.actual-solutions.index');
    }

    public function edit(ActualSolution $actualSolution)
    {
        abort_if(Gate::denies('actual_solution_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $actualSolution->load('created_by');

        return view('admin.actualSolutions.edit', compact('actualSolution'));
    }

    public function update(UpdateActualSolutionRequest $request, ActualSolution $actualSolution)
    {
        $actualSolution->update($request->all());

        return redirect()->route('admin.actual-solutions.index');
    }

    public function show(ActualSolution $actualSolution)
    {
        abort_if(Gate::denies('actual_solution_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $actualSolution->load('created_by', 'actualSolutionTeams');

        return view('admin.actualSolutions.show', compact('actualSolution'));
    }

    public function destroy(ActualSolution $actualSolution)
    {
        abort_if(Gate::denies('actual_solution_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $actualSolution->delete();

        return back();
    }

    public function massDestroy(MassDestroyActualSolutionRequest $request)
    {
        $actualSolutions = ActualSolution::find(request('ids'));

        foreach ($actualSolutions as $actualSolution) {
            $actualSolution->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
