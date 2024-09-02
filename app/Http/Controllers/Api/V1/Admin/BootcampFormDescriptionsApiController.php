<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBootcampFormDescriptionRequest;
use App\Http\Requests\UpdateBootcampFormDescriptionRequest;
use App\Http\Resources\Admin\BootcampFormDescriptionResource;
use App\Models\BootcampFormDescription;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BootcampFormDescriptionsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('bootcamp_form_description_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BootcampFormDescriptionResource(BootcampFormDescription::with(['created_by'])->get());
    }

    public function store(StoreBootcampFormDescriptionRequest $request)
    {
        $bootcampFormDescription = BootcampFormDescription::create($request->all());

        return (new BootcampFormDescriptionResource($bootcampFormDescription))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BootcampFormDescription $bootcampFormDescription)
    {
        abort_if(Gate::denies('bootcamp_form_description_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BootcampFormDescriptionResource($bootcampFormDescription->load(['created_by']));
    }

    public function update(UpdateBootcampFormDescriptionRequest $request, BootcampFormDescription $bootcampFormDescription)
    {
        $bootcampFormDescription->update($request->all());

        return (new BootcampFormDescriptionResource($bootcampFormDescription))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BootcampFormDescription $bootcampFormDescription)
    {
        abort_if(Gate::denies('bootcamp_form_description_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcampFormDescription->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
