<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActualSolutionRequest;
use App\Http\Requests\UpdateActualSolutionRequest;
use App\Http\Resources\Admin\ActualSolutionResource;
use App\Models\ActualSolution;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActualSolutionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('actual_solution_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ActualSolutionResource(ActualSolution::with(['created_by'])->get());
    }

    public function store(StoreActualSolutionRequest $request)
    {
        $actualSolution = ActualSolution::create($request->all());

        return (new ActualSolutionResource($actualSolution))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ActualSolution $actualSolution)
    {
        abort_if(Gate::denies('actual_solution_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ActualSolutionResource($actualSolution->load(['created_by']));
    }

    public function update(UpdateActualSolutionRequest $request, ActualSolution $actualSolution)
    {
        $actualSolution->update($request->all());

        return (new ActualSolutionResource($actualSolution))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ActualSolution $actualSolution)
    {
        abort_if(Gate::denies('actual_solution_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $actualSolution->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
