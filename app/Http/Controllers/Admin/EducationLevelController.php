<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEducationLevelRequest;
use App\Http\Requests\StoreEducationLevelRequest;
use App\Http\Requests\UpdateEducationLevelRequest;
use App\Models\EducationLevel;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EducationLevelController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('education_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EducationLevel::with(['created_by'])->select(sprintf('%s.*', (new EducationLevel)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'education_level_show';
                $editGate      = 'education_level_edit';
                $deleteGate    = 'education_level_delete';
                $crudRoutePart = 'education-levels';

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

        return view('admin.educationLevels.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('education_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.educationLevels.create');
    }

    public function store(StoreEducationLevelRequest $request)
    {
        $educationLevel = EducationLevel::create($request->all());

        return redirect()->route('admin.education-levels.index');
    }

    public function edit(EducationLevel $educationLevel)
    {
        abort_if(Gate::denies('education_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educationLevel->load('created_by');

        return view('admin.educationLevels.edit', compact('educationLevel'));
    }

    public function update(UpdateEducationLevelRequest $request, EducationLevel $educationLevel)
    {
        $educationLevel->update($request->all());

        return redirect()->route('admin.education-levels.index');
    }

    public function show(EducationLevel $educationLevel)
    {
        abort_if(Gate::denies('education_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educationLevel->load('created_by', 'educationalLevelBootcampParticipants');

        return view('admin.educationLevels.show', compact('educationLevel'));
    }

    public function destroy(EducationLevel $educationLevel)
    {
        abort_if(Gate::denies('education_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educationLevel->delete();

        return back();
    }

    public function massDestroy(MassDestroyEducationLevelRequest $request)
    {
        $educationLevels = EducationLevel::find(request('ids'));

        foreach ($educationLevels as $educationLevel) {
            $educationLevel->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
