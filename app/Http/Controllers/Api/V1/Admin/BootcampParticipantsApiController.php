<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBootcampParticipantRequest;
use App\Http\Requests\UpdateBootcampParticipantRequest;
use App\Http\Resources\Admin\BootcampParticipantResource;
use App\Models\BootcampParticipant;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BootcampParticipantsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('bootcamp_participant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BootcampParticipantResource(BootcampParticipant::with(['educational_level', 'field_of_study', 'first_priority', 'second_priority', 'third_priority', 'created_by'])->get());
    }

    public function store(StoreBootcampParticipantRequest $request)
    {
        $bootcampParticipant = BootcampParticipant::create($request->all());

        if ($request->input('national_id_front', false)) {
            $bootcampParticipant->addMedia(storage_path('tmp/uploads/' . basename($request->input('national_id_front'))))->toMediaCollection('national_id_front');
        }

        if ($request->input('national_id_back', false)) {
            $bootcampParticipant->addMedia(storage_path('tmp/uploads/' . basename($request->input('national_id_back'))))->toMediaCollection('national_id_back');
        }

        return (new BootcampParticipantResource($bootcampParticipant))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BootcampParticipant $bootcampParticipant)
    {
        abort_if(Gate::denies('bootcamp_participant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BootcampParticipantResource($bootcampParticipant->load(['educational_level', 'field_of_study', 'first_priority', 'second_priority', 'third_priority', 'created_by']));
    }

    public function update(UpdateBootcampParticipantRequest $request, BootcampParticipant $bootcampParticipant)
    {
        $bootcampParticipant->update($request->all());

        if ($request->input('national_id_front', false)) {
            if (! $bootcampParticipant->national_id_front || $request->input('national_id_front') !== $bootcampParticipant->national_id_front->file_name) {
                if ($bootcampParticipant->national_id_front) {
                    $bootcampParticipant->national_id_front->delete();
                }
                $bootcampParticipant->addMedia(storage_path('tmp/uploads/' . basename($request->input('national_id_front'))))->toMediaCollection('national_id_front');
            }
        } elseif ($bootcampParticipant->national_id_front) {
            $bootcampParticipant->national_id_front->delete();
        }

        if ($request->input('national_id_back', false)) {
            if (! $bootcampParticipant->national_id_back || $request->input('national_id_back') !== $bootcampParticipant->national_id_back->file_name) {
                if ($bootcampParticipant->national_id_back) {
                    $bootcampParticipant->national_id_back->delete();
                }
                $bootcampParticipant->addMedia(storage_path('tmp/uploads/' . basename($request->input('national_id_back'))))->toMediaCollection('national_id_back');
            }
        } elseif ($bootcampParticipant->national_id_back) {
            $bootcampParticipant->national_id_back->delete();
        }

        return (new BootcampParticipantResource($bootcampParticipant))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BootcampParticipant $bootcampParticipant)
    {
        abort_if(Gate::denies('bootcamp_participant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcampParticipant->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
