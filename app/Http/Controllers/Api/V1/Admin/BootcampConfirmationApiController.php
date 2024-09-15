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
//        $recaptchaToken = $request->input('recaptchaToken');
//        $isValidRecaptcha = $this->validateRecaptcha($recaptchaToken);
//
//        if (!$isValidRecaptcha) {
//            return response()->json([
//                'status' => false,
//                'message' => 'Invalid reCAPTCHA token',
//                'errors' => [
//                    "Invalid reCAPTCHA token"
//                ],
//            ], Response::HTTP_BAD_REQUEST);
//        };
//
        // Find the BootcampParticipant by email
        $participantByEmail = \App\Models\BootcampParticipant::where('email', $request->input('email'))->first();
        if (!$participantByEmail) {
            return response()->json([
                'status' => false,
                'message' => 'Participant not found for the provided email',
                'errors' => [
                    'email' => 'No participant found with this email',
                ],
            ], Response::HTTP_NOT_FOUND);
        }

        // Find the BootcampParticipant by national number
        $participantByNational = \App\Models\BootcampParticipant::where('national', $request->input('national'))->first();
        if (!$participantByNational) {
            return response()->json([
                'status' => false,
                'message' => 'Participant not found for the provided national number',
                'errors' => [
                    'national' => 'No participant found with this national number',
                ],
            ], Response::HTTP_NOT_FOUND);
        }

        // Create BootcampConfirmation with the corresponding email_id and national_id
        $bootcampConfirmation = BootcampConfirmation::create([
            'name' => $request->input('name'),
            'email_id' => $participantByEmail->id, // Use the participant's ID for email
            'national_id' => $participantByNational->id, // Use the participant's ID for national
            'phone_number' => $request->input('phone_number'),
        ]);

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
