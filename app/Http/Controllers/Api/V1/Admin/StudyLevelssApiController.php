<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreStudyLevelssRequest;
use App\Http\Requests\UpdateStudyLevelssRequest;
use App\Http\Resources\Admin\StudyLevelssResource;
use App\Models\StudyLevelss;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudyLevelssApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
//        abort_if(Gate::denies('study_levelss_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudyLevelssResource(StudyLevelss::with(['created_by'])->get());
    }

    public function store(StoreStudyLevelssRequest $request)
    {
        $studyLevelss = StudyLevelss::create($request->all());

        return (new StudyLevelssResource($studyLevelss))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StudyLevelss $studyLevelss)
    {
        abort_if(Gate::denies('study_levelss_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudyLevelssResource($studyLevelss->load(['created_by']));
    }

    public function update(UpdateStudyLevelssRequest $request, StudyLevelss $studyLevelss)
    {
        $studyLevelss->update($request->all());

        return (new StudyLevelssResource($studyLevelss))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StudyLevelss $studyLevelss)
    {
        abort_if(Gate::denies('study_levelss_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studyLevelss->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
