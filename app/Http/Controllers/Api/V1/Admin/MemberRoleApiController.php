<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMemberRoleRequest;
use App\Http\Requests\UpdateMemberRoleRequest;
use App\Http\Resources\Admin\MemberRoleResource;
use App\Models\MemberRole;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberRoleApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('member_role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MemberRoleResource(MemberRole::with(['created_by'])->get());
    }

    public function store(StoreMemberRoleRequest $request)
    {
        $memberRole = MemberRole::create($request->all());

        return (new MemberRoleResource($memberRole))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MemberRole $memberRole)
    {
        abort_if(Gate::denies('member_role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MemberRoleResource($memberRole->load(['created_by']));
    }

    public function update(UpdateMemberRoleRequest $request, MemberRole $memberRole)
    {
        $memberRole->update($request->all());

        return (new MemberRoleResource($memberRole))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MemberRole $memberRole)
    {
        abort_if(Gate::denies('member_role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $memberRole->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
