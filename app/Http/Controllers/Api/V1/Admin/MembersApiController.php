<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Http\Resources\Admin\MemberResource;
use App\Models\Member;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MembersApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('member_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MemberResource(Member::with(['major', 'study_level', 'tshirt_size', 'qr_code', 'transportation', 'created_by'])->get());
    }

    public function store(StoreMemberRequest $request)
    {
        $member = Member::create($request->all());

        if ($request->input('nationa_id_photo', false)) {
            $member->addMedia(storage_path('tmp/uploads/' . basename($request->input('nationa_id_photo'))))->toMediaCollection('nationa_id_photo');
        }

        return (new MemberResource($member))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Member $member)
    {
        abort_if(Gate::denies('member_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MemberResource($member->load(['major', 'study_level', 'tshirt_size', 'qr_code', 'transportation', 'created_by']));
    }

    public function update(UpdateMemberRequest $request, Member $member)
    {
        $member->update($request->all());

        if ($request->input('nationa_id_photo', false)) {
            if (! $member->nationa_id_photo || $request->input('nationa_id_photo') !== $member->nationa_id_photo->file_name) {
                if ($member->nationa_id_photo) {
                    $member->nationa_id_photo->delete();
                }
                $member->addMedia(storage_path('tmp/uploads/' . basename($request->input('nationa_id_photo'))))->toMediaCollection('nationa_id_photo');
            }
        } elseif ($member->nationa_id_photo) {
            $member->nationa_id_photo->delete();
        }

        return (new MemberResource($member))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Member $member)
    {
        abort_if(Gate::denies('member_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $member->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
