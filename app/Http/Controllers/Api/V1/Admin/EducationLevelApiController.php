<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEducationLevelRequest;
use App\Http\Requests\UpdateEducationLevelRequest;
use App\Http\Resources\Admin\EducationLevelResource;
use App\Models\EducationLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EducationLevelApiController extends Controller
{
    public function getAll()
    {
        return new EducationLevelResource(EducationLevel::get());
    }
    public function index()
    {
//        abort_if(Gate::denies('education_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EducationLevelResource(EducationLevel::get());
    }

    public function store(StoreEducationLevelRequest $request)
    {
        $educationLevel = EducationLevel::create($request->all());

        return (new EducationLevelResource($educationLevel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EducationLevel $educationLevel)
    {
        abort_if(Gate::denies('education_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EducationLevelResource($educationLevel->load(['created_by']));
    }

    public function update(UpdateEducationLevelRequest $request, EducationLevel $educationLevel)
    {
        $educationLevel->update($request->all());

        return (new EducationLevelResource($educationLevel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EducationLevel $educationLevel)
    {
        abort_if(Gate::denies('education_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educationLevel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
