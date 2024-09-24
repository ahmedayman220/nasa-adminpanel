<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTransportationRequest;
use App\Http\Requests\UpdateTransportationRequest;
use App\Http\Resources\Admin\TransportationResource;
use App\Models\Transportation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransportationApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
//        abort_if(Gate::denies('transportation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransportationResource(Transportation::with(['created_by'])->get());
    }

    public function store(StoreTransportationRequest $request)
    {
        $transportation = Transportation::create($request->all());

        return (new TransportationResource($transportation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Transportation $transportation)
    {
        abort_if(Gate::denies('transportation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransportationResource($transportation->load(['created_by']));
    }

    public function update(UpdateTransportationRequest $request, Transportation $transportation)
    {
        $transportation->update($request->all());

        return (new TransportationResource($transportation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Transportation $transportation)
    {
        abort_if(Gate::denies('transportation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
