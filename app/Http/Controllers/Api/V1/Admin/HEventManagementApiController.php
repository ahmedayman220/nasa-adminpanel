<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHEventManagementRequest;
use App\Http\Requests\UpdateHEventManagementRequest;
use App\Http\Resources\Admin\HEventManagementResource;
use App\Models\HEventManagement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HEventManagementApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('h_event_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HEventManagementResource(HEventManagement::with(['created_by'])->get());
    }

    public function store(StoreHEventManagementRequest $request)
    {
        $hEventManagement = HEventManagement::create($request->all());

        return (new HEventManagementResource($hEventManagement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(HEventManagement $hEventManagement)
    {
        abort_if(Gate::denies('h_event_management_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HEventManagementResource($hEventManagement->load(['created_by']));
    }

    public function update(UpdateHEventManagementRequest $request, HEventManagement $hEventManagement)
    {
        $hEventManagement->update($request->all());

        return (new HEventManagementResource($hEventManagement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(HEventManagement $hEventManagement)
    {
        abort_if(Gate::denies('h_event_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hEventManagement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
