<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMentionYourFieldRequest;
use App\Http\Requests\UpdateMentionYourFieldRequest;
use App\Http\Resources\Admin\MentionYourFieldResource;
use App\Models\MentionYourField;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MentionYourFieldApiController extends Controller
{
    public function index()
    {
//        abort_if(Gate::denies('mention_your_field_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MentionYourFieldResource(MentionYourField::with(['created_by'])->get());
    }

    public function store(StoreMentionYourFieldRequest $request)
    {
        $mentionYourField = MentionYourField::create($request->all());

        return (new MentionYourFieldResource($mentionYourField))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MentionYourField $mentionYourField)
    {
        abort_if(Gate::denies('mention_your_field_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MentionYourFieldResource($mentionYourField->load(['created_by']));
    }

    public function update(UpdateMentionYourFieldRequest $request, MentionYourField $mentionYourField)
    {
        $mentionYourField->update($request->all());

        return (new MentionYourFieldResource($mentionYourField))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MentionYourField $mentionYourField)
    {
        abort_if(Gate::denies('mention_your_field_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mentionYourField->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
