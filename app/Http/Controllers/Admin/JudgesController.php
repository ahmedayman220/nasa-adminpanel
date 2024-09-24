<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyJudgeRequest;
use App\Http\Requests\StoreJudgeRequest;
use App\Http\Requests\UpdateJudgeRequest;
use App\Models\Judge;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class JudgesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('judge_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Judge::with(['created_by'])->select(sprintf('%s.*', (new Judge)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'judge_show';
                $editGate      = 'judge_edit';
                $deleteGate    = 'judge_delete';
                $crudRoutePart = 'judges';

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
            $table->editColumn('expertise', function ($row) {
                return $row->expertise ? $row->expertise : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.judges.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('judge_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.judges.create');
    }

    public function store(StoreJudgeRequest $request)
    {
        $judge = Judge::create($request->all());

        return redirect()->route('admin.judges.index');
    }

    public function edit(Judge $judge)
    {
        abort_if(Gate::denies('judge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $judge->load('created_by');

        return view('admin.judges.edit', compact('judge'));
    }

    public function update(UpdateJudgeRequest $request, Judge $judge)
    {
        $judge->update($request->all());

        return redirect()->route('admin.judges.index');
    }

    public function show(Judge $judge)
    {
        abort_if(Gate::denies('judge_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $judge->load('created_by', 'judgeEvaluations');

        return view('admin.judges.show', compact('judge'));
    }

    public function destroy(Judge $judge)
    {
        abort_if(Gate::denies('judge_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $judge->delete();

        return back();
    }

    public function massDestroy(MassDestroyJudgeRequest $request)
    {
        $judges = Judge::find(request('ids'));

        foreach ($judges as $judge) {
            $judge->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
