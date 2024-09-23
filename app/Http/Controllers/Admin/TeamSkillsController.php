<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTeamSkillRequest;
use App\Http\Requests\StoreTeamSkillRequest;
use App\Http\Requests\UpdateTeamSkillRequest;
use App\Models\Skill;
use App\Models\TeamSkill;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TeamSkillsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('team_skill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TeamSkill::with(['skill', 'created_by'])->select(sprintf('%s.*', (new TeamSkill)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'team_skill_show';
                $editGate      = 'team_skill_edit';
                $deleteGate    = 'team_skill_delete';
                $crudRoutePart = 'team-skills';

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
            $table->addColumn('skill_name', function ($row) {
                return $row->skill ? $row->skill->name : '';
            });

            $table->editColumn('proficiency_level', function ($row) {
                return $row->proficiency_level ? $row->proficiency_level : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'skill']);

            return $table->make(true);
        }

        $skills = Skill::get();
        $users  = User::get();

        return view('admin.teamSkills.index', compact('skills', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('team_skill_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skills = Skill::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.teamSkills.create', compact('skills'));
    }

    public function store(StoreTeamSkillRequest $request)
    {
        $teamSkill = TeamSkill::create($request->all());

        return redirect()->route('admin.team-skills.index');
    }

    public function edit(TeamSkill $teamSkill)
    {
        abort_if(Gate::denies('team_skill_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skills = Skill::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teamSkill->load('skill', 'created_by');

        return view('admin.teamSkills.edit', compact('skills', 'teamSkill'));
    }

    public function update(UpdateTeamSkillRequest $request, TeamSkill $teamSkill)
    {
        $teamSkill->update($request->all());

        return redirect()->route('admin.team-skills.index');
    }

    public function show(TeamSkill $teamSkill)
    {
        abort_if(Gate::denies('team_skill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teamSkill->load('skill', 'created_by');

        return view('admin.teamSkills.show', compact('teamSkill'));
    }

    public function destroy(TeamSkill $teamSkill)
    {
        abort_if(Gate::denies('team_skill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teamSkill->delete();

        return back();
    }

    public function massDestroy(MassDestroyTeamSkillRequest $request)
    {
        $teamSkills = TeamSkill::find(request('ids'));

        foreach ($teamSkills as $teamSkill) {
            $teamSkill->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
