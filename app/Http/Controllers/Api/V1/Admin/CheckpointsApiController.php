<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCheckpointRequest;
use App\Http\Requests\UpdateCheckpointRequest;
use App\Http\Resources\Admin\CheckpointResource;
use App\Models\Checkpoint;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckpointsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('checkpoint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CheckpointResource(Checkpoint::with(['event', 'checkpoint_type', 'created_by'])->get());
    }

    public function store(StoreCheckpointRequest $request)
    {
        $checkpoint = Checkpoint::create($request->all());

        return (new CheckpointResource($checkpoint))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Checkpoint $checkpoint)
    {
        abort_if(Gate::denies('checkpoint_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CheckpointResource($checkpoint->load(['event', 'checkpoint_type', 'created_by']));
    }

    public function update(UpdateCheckpointRequest $request, Checkpoint $checkpoint)
    {
        $checkpoint->update($request->all());

        return (new CheckpointResource($checkpoint))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Checkpoint $checkpoint)
    {
        abort_if(Gate::denies('checkpoint_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkpoint->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
