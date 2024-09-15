<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyStudyLevelRequest;
use App\Http\Requests\StoreStudyLevelRequest;
use App\Http\Requests\UpdateStudyLevelRequest;
use App\Models\StudyLevel;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudyLevelController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('study_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StudyLevel::with(['created_by'])->select(sprintf('%s.*', (new StudyLevel)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'study_level_show';
                $editGate      = 'study_level_edit';
                $deleteGate    = 'study_level_delete';
                $crudRoutePart = 'study-levels';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.studyLevels.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('study_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.studyLevels.create');
    }

    public function store(StoreStudyLevelRequest $request)
    {
        $studyLevel = StudyLevel::create($request->all());

        return redirect()->route('admin.study-levels.index');
    }

    public function edit(StudyLevel $studyLevel)
    {
        abort_if(Gate::denies('study_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studyLevel->load('created_by');

        return view('admin.studyLevels.edit', compact('studyLevel'));
    }

    public function update(UpdateStudyLevelRequest $request, StudyLevel $studyLevel)
    {
        $studyLevel->update($request->all());

        return redirect()->route('admin.study-levels.index');
    }

    public function show(StudyLevel $studyLevel)
    {
        abort_if(Gate::denies('study_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studyLevel->load('created_by', 'slotBootcampConfirmations');

        return view('admin.studyLevels.show', compact('studyLevel'));
    }

    public function destroy(StudyLevel $studyLevel)
    {
        abort_if(Gate::denies('study_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studyLevel->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudyLevelRequest $request)
    {
        $studyLevels = StudyLevel::find(request('ids'));

        foreach ($studyLevels as $studyLevel) {
            $studyLevel->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
