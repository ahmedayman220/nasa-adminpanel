<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdateMajorRequest;
use App\Http\Resources\Admin\MajorResource;
use App\Models\Major;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MajorApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('major_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MajorResource(Major::with(['created_by'])->get());
    }

    public function store(StoreMajorRequest $request)
    {
        $major = Major::create($request->all());

        return (new MajorResource($major))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Major $major)
    {
        abort_if(Gate::denies('major_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MajorResource($major->load(['created_by']));
    }

    public function update(UpdateMajorRequest $request, Major $major)
    {
        $major->update($request->all());

        return (new MajorResource($major))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Major $major)
    {
        abort_if(Gate::denies('major_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $major->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
