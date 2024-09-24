<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTeamAchievementRequest;
use App\Http\Requests\StoreTeamAchievementRequest;
use App\Http\Requests\UpdateTeamAchievementRequest;
use App\Models\Achievement;
use App\Models\TeamAchievement;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TeamAchievementsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('team_achievement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TeamAchievement::with(['achievement', 'created_by'])->select(sprintf('%s.*', (new TeamAchievement)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'team_achievement_show';
                $editGate      = 'team_achievement_edit';
                $deleteGate    = 'team_achievement_delete';
                $crudRoutePart = 'team-achievements';

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
            $table->addColumn('achievement_name', function ($row) {
                return $row->achievement ? $row->achievement->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'achievement']);

            return $table->make(true);
        }

        $achievements = Achievement::get();
        $users        = User::get();

        return view('admin.teamAchievements.index', compact('achievements', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('team_achievement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $achievements = Achievement::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.teamAchievements.create', compact('achievements'));
    }

    public function store(StoreTeamAchievementRequest $request)
    {
        $teamAchievement = TeamAchievement::create($request->all());

        return redirect()->route('admin.team-achievements.index');
    }

    public function edit(TeamAchievement $teamAchievement)
    {
        abort_if(Gate::denies('team_achievement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $achievements = Achievement::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teamAchievement->load('achievement', 'created_by');

        return view('admin.teamAchievements.edit', compact('achievements', 'teamAchievement'));
    }

    public function update(UpdateTeamAchievementRequest $request, TeamAchievement $teamAchievement)
    {
        $teamAchievement->update($request->all());

        return redirect()->route('admin.team-achievements.index');
    }

    public function show(TeamAchievement $teamAchievement)
    {
        abort_if(Gate::denies('team_achievement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teamAchievement->load('achievement', 'created_by');

        return view('admin.teamAchievements.show', compact('teamAchievement'));
    }

    public function destroy(TeamAchievement $teamAchievement)
    {
        abort_if(Gate::denies('team_achievement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teamAchievement->delete();

        return back();
    }

    public function massDestroy(MassDestroyTeamAchievementRequest $request)
    {
        $teamAchievements = TeamAchievement::find(request('ids'));

        foreach ($teamAchievements as $teamAchievement) {
            $teamAchievement->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
