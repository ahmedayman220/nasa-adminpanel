<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTshirtSizeRequest;
use App\Http\Requests\UpdateTshirtSizeRequest;
use App\Http\Resources\Admin\TshirtSizeResource;
use App\Models\TshirtSize;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TshirtSizeApiController extends Controller
{
    public function index()
    {
//        abort_if(Gate::denies('tshirt_size_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TshirtSizeResource(TshirtSize::with(['created_by'])->get());
    }

    public function store(StoreTshirtSizeRequest $request)
    {
        $tshirtSize = TshirtSize::create($request->all());

        return (new TshirtSizeResource($tshirtSize))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TshirtSize $tshirtSize)
    {
        abort_if(Gate::denies('tshirt_size_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TshirtSizeResource($tshirtSize->load(['created_by']));
    }

    public function update(UpdateTshirtSizeRequest $request, TshirtSize $tshirtSize)
    {
        $tshirtSize->update($request->all());

        return (new TshirtSizeResource($tshirtSize))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TshirtSize $tshirtSize)
    {
        abort_if(Gate::denies('tshirt_size_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tshirtSize->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
