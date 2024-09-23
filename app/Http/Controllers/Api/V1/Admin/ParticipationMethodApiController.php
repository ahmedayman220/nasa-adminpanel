<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreParticipationMethodRequest;
use App\Http\Requests\UpdateParticipationMethodRequest;
use App\Http\Resources\Admin\ParticipationMethodResource;
use App\Models\ParticipationMethod;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParticipationMethodApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('participation_method_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ParticipationMethodResource(ParticipationMethod::with(['created_by'])->get());
    }

    public function store(StoreParticipationMethodRequest $request)
    {
        $participationMethod = ParticipationMethod::create($request->all());

        return (new ParticipationMethodResource($participationMethod))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ParticipationMethod $participationMethod)
    {
        abort_if(Gate::denies('participation_method_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ParticipationMethodResource($participationMethod->load(['created_by']));
    }

    public function update(UpdateParticipationMethodRequest $request, ParticipationMethod $participationMethod)
    {
        $participationMethod->update($request->all());

        return (new ParticipationMethodResource($participationMethod))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ParticipationMethod $participationMethod)
    {
        abort_if(Gate::denies('participation_method_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participationMethod->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
