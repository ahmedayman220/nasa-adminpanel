<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEvaluationRequest;
use App\Http\Requests\StoreEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use App\Models\Evaluation;
use App\Models\EvaluationCriterion;
use App\Models\Judge;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EvaluationsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('evaluation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Evaluation::with(['judge', 'criteria', 'created_by'])->select(sprintf('%s.*', (new Evaluation)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'evaluation_show';
                $editGate      = 'evaluation_edit';
                $deleteGate    = 'evaluation_delete';
                $crudRoutePart = 'evaluations';

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
            $table->addColumn('judge_name', function ($row) {
                return $row->judge ? $row->judge->name : '';
            });

            $table->editColumn('score', function ($row) {
                return $row->score ? $row->score : '';
            });
            $table->addColumn('criteria_name', function ($row) {
                return $row->criteria ? $row->criteria->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'judge', 'criteria']);

            return $table->make(true);
        }

        $judges              = Judge::get();
        $evaluation_criteria = EvaluationCriterion::get();
        $users               = User::get();

        return view('admin.evaluations.index', compact('judges', 'evaluation_criteria', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('evaluation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $judges = Judge::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $criterias = EvaluationCriterion::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.evaluations.create', compact('criterias', 'judges'));
    }

    public function store(StoreEvaluationRequest $request)
    {
        $evaluation = Evaluation::create($request->all());

        return redirect()->route('admin.evaluations.index');
    }

    public function edit(Evaluation $evaluation)
    {
        abort_if(Gate::denies('evaluation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $judges = Judge::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $criterias = EvaluationCriterion::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $evaluation->load('judge', 'criteria', 'created_by');

        return view('admin.evaluations.edit', compact('criterias', 'evaluation', 'judges'));
    }

    public function update(UpdateEvaluationRequest $request, Evaluation $evaluation)
    {
        $evaluation->update($request->all());

        return redirect()->route('admin.evaluations.index');
    }

    public function show(Evaluation $evaluation)
    {
        abort_if(Gate::denies('evaluation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $evaluation->load('judge', 'criteria', 'created_by');

        return view('admin.evaluations.show', compact('evaluation'));
    }

    public function destroy(Evaluation $evaluation)
    {
        abort_if(Gate::denies('evaluation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $evaluation->delete();

        return back();
    }

    public function massDestroy(MassDestroyEvaluationRequest $request)
    {
        $evaluations = Evaluation::find(request('ids'));

        foreach ($evaluations as $evaluation) {
            $evaluation->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
