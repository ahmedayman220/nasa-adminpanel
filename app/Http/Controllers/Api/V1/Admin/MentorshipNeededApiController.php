<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMentorshipNeededRequest;
use App\Http\Requests\UpdateMentorshipNeededRequest;
use App\Http\Resources\Admin\MentorshipNeededResource;
use App\Models\MentorshipNeeded;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MentorshipNeededApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('mentorship_needed_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MentorshipNeededResource(MentorshipNeeded::with(['created_by'])->get());
    }

    public function store(StoreMentorshipNeededRequest $request)
    {
        $mentorshipNeeded = MentorshipNeeded::create($request->all());

        return (new MentorshipNeededResource($mentorshipNeeded))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MentorshipNeeded $mentorshipNeeded)
    {
        abort_if(Gate::denies('mentorship_needed_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MentorshipNeededResource($mentorshipNeeded->load(['created_by']));
    }

    public function update(UpdateMentorshipNeededRequest $request, MentorshipNeeded $mentorshipNeeded)
    {
        $mentorshipNeeded->update($request->all());

        return (new MentorshipNeededResource($mentorshipNeeded))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MentorshipNeeded $mentorshipNeeded)
    {
        abort_if(Gate::denies('mentorship_needed_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mentorshipNeeded->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
