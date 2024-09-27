<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreJudgeRequest;
use App\Http\Requests\UpdateJudgeRequest;
use App\Http\Resources\Admin\JudgeResource;
use App\Models\Judge;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JudgesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('judge_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JudgeResource(Judge::with(['created_by'])->get());
    }

    public function store(StoreJudgeRequest $request)
    {
        $judge = Judge::create($request->all());

        if ($request->input('photo', false)) {
            $judge->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new JudgeResource($judge))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Judge $judge)
    {
        abort_if(Gate::denies('judge_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JudgeResource($judge->load(['created_by']));
    }

    public function update(UpdateJudgeRequest $request, Judge $judge)
    {
        $judge->update($request->all());

        if ($request->input('photo', false)) {
            if (! $judge->photo || $request->input('photo') !== $judge->photo->file_name) {
                if ($judge->photo) {
                    $judge->photo->delete();
                }
                $judge->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($judge->photo) {
            $judge->photo->delete();
        }

        return (new JudgeResource($judge))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Judge $judge)
    {
        abort_if(Gate::denies('judge_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $judge->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
