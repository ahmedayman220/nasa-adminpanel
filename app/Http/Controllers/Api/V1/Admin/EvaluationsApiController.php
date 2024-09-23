<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use App\Http\Resources\Admin\EvaluationResource;
use App\Models\Evaluation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EvaluationsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('evaluation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EvaluationResource(Evaluation::with(['judge', 'criteria', 'created_by'])->get());
    }

    public function store(StoreEvaluationRequest $request)
    {
        $evaluation = Evaluation::create($request->all());

        return (new EvaluationResource($evaluation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Evaluation $evaluation)
    {
        abort_if(Gate::denies('evaluation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EvaluationResource($evaluation->load(['judge', 'criteria', 'created_by']));
    }

    public function update(UpdateEvaluationRequest $request, Evaluation $evaluation)
    {
        $evaluation->update($request->all());

        return (new EvaluationResource($evaluation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Evaluation $evaluation)
    {
        abort_if(Gate::denies('evaluation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $evaluation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
