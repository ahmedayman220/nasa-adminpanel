<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudyLevelRequest;
use App\Http\Requests\UpdateStudyLevelRequest;
use App\Http\Resources\Admin\StudyLevelResource;
use App\Models\StudyLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudyLevelApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('study_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudyLevelResource(StudyLevel::with(['created_by'])->get());
    }

    public function store(StoreStudyLevelRequest $request)
    {
        $studyLevel = StudyLevel::create($request->all());

        return (new StudyLevelResource($studyLevel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StudyLevel $studyLevel)
    {
        abort_if(Gate::denies('study_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudyLevelResource($studyLevel->load(['created_by']));
    }

    public function update(UpdateStudyLevelRequest $request, StudyLevel $studyLevel)
    {
        $studyLevel->update($request->all());

        return (new StudyLevelResource($studyLevel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StudyLevel $studyLevel)
    {
        abort_if(Gate::denies('study_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studyLevel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
