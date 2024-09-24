<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCheckpointTypeRequest;
use App\Http\Requests\UpdateCheckpointTypeRequest;
use App\Http\Resources\Admin\CheckpointTypeResource;
use App\Models\CheckpointType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckpointTypesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('checkpoint_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CheckpointTypeResource(CheckpointType::with(['created_by'])->get());
    }

    public function store(StoreCheckpointTypeRequest $request)
    {
        $checkpointType = CheckpointType::create($request->all());

        return (new CheckpointTypeResource($checkpointType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CheckpointType $checkpointType)
    {
        abort_if(Gate::denies('checkpoint_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CheckpointTypeResource($checkpointType->load(['created_by']));
    }

    public function update(UpdateCheckpointTypeRequest $request, CheckpointType $checkpointType)
    {
        $checkpointType->update($request->all());

        return (new CheckpointTypeResource($checkpointType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CheckpointType $checkpointType)
    {
        abort_if(Gate::denies('checkpoint_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpointType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
