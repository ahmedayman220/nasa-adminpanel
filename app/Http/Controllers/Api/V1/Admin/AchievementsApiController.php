<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAchievementRequest;
use App\Http\Requests\UpdateAchievementRequest;
use App\Http\Resources\Admin\AchievementResource;
use App\Models\Achievement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AchievementsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('achievement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AchievementResource(Achievement::with(['created_by'])->get());
    }

    public function store(StoreAchievementRequest $request)
    {
        $achievement = Achievement::create($request->all());

        return (new AchievementResource($achievement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Achievement $achievement)
    {
        abort_if(Gate::denies('achievement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AchievementResource($achievement->load(['created_by']));
    }

    public function update(UpdateAchievementRequest $request, Achievement $achievement)
    {
        $achievement->update($request->all());

        return (new AchievementResource($achievement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Achievement $achievement)
    {
        abort_if(Gate::denies('achievement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $achievement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
