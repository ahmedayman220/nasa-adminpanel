<?php

namespace App\Http\Controllers\Api\V1\Admin;
use App\Helpers\BootcampHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBootcampConfirmationRequest;
use App\Http\Requests\UpdateBootcampConfirmationRequest;
use App\Http\Resources\Admin\BootcampConfirmationResource;
use App\Models\BootcampConfirmation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BootcampConfirmationApiController extends Controller
{
    use BootcampHelper;

    public function index()
    {
        abort_if(Gate::denies('bootcamp_confirmation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BootcampConfirmationResource(BootcampConfirmation::with(['email', 'national', 'slot', 'created_by'])->get());
    }

    public function store(StoreBootcampConfirmationRequest $request)
    {
        // Validate reCAPTCHA
        $recaptchaToken = $request->input('recaptchaToken');
        $isValidRecaptcha = $this->validateRecaptcha($recaptchaToken);

        if (!$isValidRecaptcha) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid reCAPTCHA token',
                'errors' => [
                    "Invalid reCAPTCHA token"
                ],
            ], Response::HTTP_BAD_REQUEST);
        };

        $bootcampConfirmation = BootcampConfirmation::create($request->all());

        return (new BootcampConfirmationResource($bootcampConfirmation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BootcampConfirmation $bootcampConfirmation)
    {
        abort_if(Gate::denies('bootcamp_confirmation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BootcampConfirmationResource($bootcampConfirmation->load(['email', 'national', 'slot', 'created_by']));
    }

    public function update(UpdateBootcampConfirmationRequest $request, BootcampConfirmation $bootcampConfirmation)
    {
        $bootcampConfirmation->update($request->all());

        return (new BootcampConfirmationResource($bootcampConfirmation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BootcampConfirmation $bootcampConfirmation)
    {
        abort_if(Gate::denies('bootcamp_confirmation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcampConfirmation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
