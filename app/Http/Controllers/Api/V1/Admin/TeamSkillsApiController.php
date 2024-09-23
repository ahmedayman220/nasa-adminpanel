<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamSkillRequest;
use App\Http\Requests\UpdateTeamSkillRequest;
use App\Http\Resources\Admin\TeamSkillResource;
use App\Models\TeamSkill;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamSkillsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('team_skill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TeamSkillResource(TeamSkill::with(['skill', 'created_by'])->get());
    }

    public function store(StoreTeamSkillRequest $request)
    {
        $teamSkill = TeamSkill::create($request->all());

        return (new TeamSkillResource($teamSkill))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TeamSkill $teamSkill)
    {
        abort_if(Gate::denies('team_skill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TeamSkillResource($teamSkill->load(['skill', 'created_by']));
    }

    public function update(UpdateTeamSkillRequest $request, TeamSkill $teamSkill)
    {
        $teamSkill->update($request->all());

        return (new TeamSkillResource($teamSkill))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TeamSkill $teamSkill)
    {
        abort_if(Gate::denies('team_skill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teamSkill->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
