<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAchievementRequest;
use App\Http\Requests\StoreAchievementRequest;
use App\Http\Requests\UpdateAchievementRequest;
use App\Models\Achievement;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AchievementsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('achievement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Achievement::with(['created_by'])->select(sprintf('%s.*', (new Achievement)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'achievement_show';
                $editGate      = 'achievement_edit';
                $deleteGate    = 'achievement_delete';
                $crudRoutePart = 'achievements';

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
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.achievements.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('achievement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.achievements.create');
    }

    public function store(StoreAchievementRequest $request)
    {
        $achievement = Achievement::create($request->all());

        return redirect()->route('admin.achievements.index');
    }

    public function edit(Achievement $achievement)
    {
        abort_if(Gate::denies('achievement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $achievement->load('created_by');

        return view('admin.achievements.edit', compact('achievement'));
    }

    public function update(UpdateAchievementRequest $request, Achievement $achievement)
    {
        $achievement->update($request->all());

        return redirect()->route('admin.achievements.index');
    }

    public function show(Achievement $achievement)
    {
        abort_if(Gate::denies('achievement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $achievement->load('created_by', 'achievementTeamAchievements');

        return view('admin.achievements.show', compact('achievement'));
    }

    public function destroy(Achievement $achievement)
    {
        abort_if(Gate::denies('achievement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $achievement->delete();

        return back();
    }

    public function massDestroy(MassDestroyAchievementRequest $request)
    {
        $achievements = Achievement::find(request('ids'));

        foreach ($achievements as $achievement) {
            $achievement->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
