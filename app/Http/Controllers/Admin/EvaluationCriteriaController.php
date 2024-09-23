<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEvaluationCriterionRequest;
use App\Http\Requests\StoreEvaluationCriterionRequest;
use App\Http\Requests\UpdateEvaluationCriterionRequest;
use App\Models\EvaluationCriterion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EvaluationCriteriaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('evaluation_criterion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EvaluationCriterion::with(['created_by'])->select(sprintf('%s.*', (new EvaluationCriterion)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'evaluation_criterion_show';
                $editGate      = 'evaluation_criterion_edit';
                $deleteGate    = 'evaluation_criterion_delete';
                $crudRoutePart = 'evaluation-criteria';

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
            $table->editColumn('weight', function ($row) {
                return $row->weight ? $row->weight : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.evaluationCriteria.index');
    }

    public function create()
    {
        abort_if(Gate::denies('evaluation_criterion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.evaluationCriteria.create');
    }

    public function store(StoreEvaluationCriterionRequest $request)
    {
        $evaluationCriterion = EvaluationCriterion::create($request->all());

        return redirect()->route('admin.evaluation-criteria.index');
    }

    public function edit(EvaluationCriterion $evaluationCriterion)
    {
        abort_if(Gate::denies('evaluation_criterion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $evaluationCriterion->load('created_by');

        return view('admin.evaluationCriteria.edit', compact('evaluationCriterion'));
    }

    public function update(UpdateEvaluationCriterionRequest $request, EvaluationCriterion $evaluationCriterion)
    {
        $evaluationCriterion->update($request->all());

        return redirect()->route('admin.evaluation-criteria.index');
    }

    public function show(EvaluationCriterion $evaluationCriterion)
    {
        abort_if(Gate::denies('evaluation_criterion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $evaluationCriterion->load('created_by', 'criteriaEvaluations');

        return view('admin.evaluationCriteria.show', compact('evaluationCriterion'));
    }

    public function destroy(EvaluationCriterion $evaluationCriterion)
    {
        abort_if(Gate::denies('evaluation_criterion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $evaluationCriterion->delete();

        return back();
    }

    public function massDestroy(MassDestroyEvaluationCriterionRequest $request)
    {
        $evaluationCriteria = EvaluationCriterion::find(request('ids'));

        foreach ($evaluationCriteria as $evaluationCriterion) {
            $evaluationCriterion->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
