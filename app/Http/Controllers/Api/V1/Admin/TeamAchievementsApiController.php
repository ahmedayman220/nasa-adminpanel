<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamAchievementRequest;
use App\Http\Requests\UpdateTeamAchievementRequest;
use App\Http\Resources\Admin\TeamAchievementResource;
use App\Models\TeamAchievement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamAchievementsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('team_achievement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TeamAchievementResource(TeamAchievement::with(['achievement', 'created_by'])->get());
    }

    public function store(StoreTeamAchievementRequest $request)
    {
        $teamAchievement = TeamAchievement::create($request->all());

        return (new TeamAchievementResource($teamAchievement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TeamAchievement $teamAchievement)
    {
        abort_if(Gate::denies('team_achievement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TeamAchievementResource($teamAchievement->load(['achievement', 'created_by']));
    }

    public function update(UpdateTeamAchievementRequest $request, TeamAchievement $teamAchievement)
    {
        $teamAchievement->update($request->all());

        return (new TeamAchievementResource($teamAchievement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TeamAchievement $teamAchievement)
    {
        abort_if(Gate::denies('team_achievement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teamAchievement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
