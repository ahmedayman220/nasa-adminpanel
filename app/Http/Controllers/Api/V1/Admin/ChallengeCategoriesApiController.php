<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChallengeCategoryRequest;
use App\Http\Requests\UpdateChallengeCategoryRequest;
use App\Http\Resources\Admin\ChallengeCategoryResource;
use App\Models\ChallengeCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChallengeCategoriesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('challenge_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChallengeCategoryResource(ChallengeCategory::with(['created_by'])->get());
    }

    public function store(StoreChallengeCategoryRequest $request)
    {
        $challengeCategory = ChallengeCategory::create($request->all());

        return (new ChallengeCategoryResource($challengeCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ChallengeCategory $challengeCategory)
    {
        abort_if(Gate::denies('challenge_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChallengeCategoryResource($challengeCategory->load(['created_by']));
    }

    public function update(UpdateChallengeCategoryRequest $request, ChallengeCategory $challengeCategory)
    {
        $challengeCategory->update($request->all());

        return (new ChallengeCategoryResource($challengeCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ChallengeCategory $challengeCategory)
    {
        abort_if(Gate::denies('challenge_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $challengeCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
