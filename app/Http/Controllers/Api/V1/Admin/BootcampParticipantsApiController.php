<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Helpers\BootcampHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBootcampParticipantRequest;
use App\Http\Requests\UpdateBootcampParticipantRequest;
use App\Http\Requests\AuthToUpdateBootcampParticipantApiRequest;
use App\Http\Resources\Admin\BootcampParticipantResource;
use App\Models\BootcampParticipant;
use App\Models\ParticipantWorkshopPreference;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class BootcampParticipantsApiController extends Controller
{
    use MediaUploadingTrait;

    private function validateRecaptcha($token)
    {
        $secretKey = '6LdunDYqAAAAAKtyYz-mPPTcYadAr0Wxpyaa-akS'; // Your secret key

        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$token}");
        $responseKeys = json_decode($response, true);

        return $responseKeys['success'];
    }

    public function index()
    {
        abort_if(Gate::denies('bootcamp_participant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BootcampParticipantResource(BootcampParticipant::with(['educational_level', 'field_of_study', 'first_priority', 'second_priority', 'third_priority', 'created_by'])->get());
    }

    public function store(StoreBootcampParticipantRequest $request)
    {
        // Validate reCAPTCHA
        $recaptchaToken = $request->input('recaptchaToken');
        $isValidRecaptcha = $this->validateRecaptcha($recaptchaToken);

        if (!$isValidRecaptcha) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid reCAPTCHA token',
            ], Response::HTTP_BAD_REQUEST);
        }

        $bootcampParticipant = BootcampParticipant::create($request->all());

        if (isset($bootcampParticipant->first_priority_id)) {
            ParticipantWorkshopPreference::create([
                'bootcamp_participant_id' => $bootcampParticipant->id, // Assuming 'id' is the participant ID
                'workshop_id' => $bootcampParticipant->first_priority_id,
                'preference_order' => 1,
            ]);
        }

        if (isset($bootcampParticipant->second_priority_id)) {
            ParticipantWorkshopPreference::create([
                'bootcamp_participant_id' => $bootcampParticipant->id, // Assuming 'id' is the participant ID
                'workshop_id' => $bootcampParticipant->second_priority_id,
                'preference_order' => 2,
            ]);
        }

        if (isset($bootcampParticipant->third_priority_id)) {
            ParticipantWorkshopPreference::create([
                'bootcamp_participant_id' => $bootcampParticipant->id, // Assuming 'id' is the participant ID
                'workshop_id' => $bootcampParticipant->third_priority_id,
                'preference_order' => 3,
            ]);
        }

        BootcampHelper::checkAvailability($bootcampParticipant->id);

        if ($request->input('national_id_front', false)) {
            $bootcampParticipant->addMedia(storage_path('tmp/uploads/' . basename($request->input('national_id_front'))))->toMediaCollection('national_id_front');
        }

        if ($request->input('national_id_back', false)) {
            $bootcampParticipant->addMedia(storage_path('tmp/uploads/' . basename($request->input('national_id_back'))))->toMediaCollection('national_id_back');
        }

        return response()->json([
            'status'          => True,
        ]);
    }

    public function show(AuthToUpdateBootcampParticipantApiRequest $request)
    {

        $request->validated();
        $data = BootcampParticipant::where('email',$request->email)->where('national',$request->national)->first();

        return (new BootcampParticipantResource($data))->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
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
