<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvaluationCriterionRequest;
use App\Http\Requests\UpdateEvaluationCriterionRequest;
use App\Http\Resources\Admin\EvaluationCriterionResource;
use App\Models\EvaluationCriterion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EvaluationCriteriaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('evaluation_criterion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EvaluationCriterionResource(EvaluationCriterion::with(['created_by'])->get());
    }

    public function store(StoreEvaluationCriterionRequest $request)
    {
        $evaluationCriterion = EvaluationCriterion::create($request->all());

        return (new EvaluationCriterionResource($evaluationCriterion))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EvaluationCriterion $evaluationCriterion)
    {
        abort_if(Gate::denies('evaluation_criterion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EvaluationCriterionResource($evaluationCriterion->load(['created_by']));
    }

    public function update(UpdateEvaluationCriterionRequest $request, EvaluationCriterion $evaluationCriterion)
    {
        $evaluationCriterion->update($request->all());

        return (new EvaluationCriterionResource($evaluationCriterion))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EvaluationCriterion $evaluationCriterion)
    {
        abort_if(Gate::denies('evaluation_criterion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $evaluationCriterion->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
