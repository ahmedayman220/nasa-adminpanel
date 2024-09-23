<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMemberCheckpointRequest;
use App\Http\Requests\UpdateMemberCheckpointRequest;
use App\Http\Resources\Admin\MemberCheckpointResource;
use App\Models\MemberCheckpoint;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberCheckpointsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('member_checkpoint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MemberCheckpointResource(MemberCheckpoint::with(['member', 'checkpoint', 'created_by'])->get());
    }

    public function store(StoreMemberCheckpointRequest $request)
    {
        $memberCheckpoint = MemberCheckpoint::create($request->all());

        return (new MemberCheckpointResource($memberCheckpoint))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MemberCheckpoint $memberCheckpoint)
    {
        abort_if(Gate::denies('member_checkpoint_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MemberCheckpointResource($memberCheckpoint->load(['member', 'checkpoint', 'created_by']));
    }

    public function update(UpdateMemberCheckpointRequest $request, MemberCheckpoint $memberCheckpoint)
    {
        $memberCheckpoint->update($request->all());

        return (new MemberCheckpointResource($memberCheckpoint))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MemberCheckpoint $memberCheckpoint)
    {
        abort_if(Gate::denies('member_checkpoint_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $memberCheckpoint->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
