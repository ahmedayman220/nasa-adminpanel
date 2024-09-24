<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Helpers\BootcampHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\StorehackathonRegistrationRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Http\Resources\Admin\BootcampParticipantResource;
use App\Http\Resources\Admin\TeamResource;
use App\Models\Member;
use App\Models\Team;
use Gate;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamApiController extends Controller
{
    use MediaUploadingTrait , BootcampHelper;

    public function index()
    {
        abort_if(Gate::denies('team_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TeamResource(Team::with(['team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method'])->get());
    }

    public function HackathonRegistration(StorehackathonRegistrationRequest $request) {


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



        // Extract team data from the request
        $team_data = $request->only([
            'team_name', 'challenge_id', 'actual_solution_id', 'mentorship_needed_id',
            'participation_method_id', 'limited_capacity', 'members_participated_before',
            'project_proposal_url', 'project_video_url','comment', 'participated_hackathons'
        ]);

        // Store the team photo URL in the extra_field
        $team_data['extra_field'] = $request->input('team_photo');

        // Create the team
        $team = Team::create($team_data);

        // Loop through each member from the request
        foreach ($request->input('members') as $key => $memberData) {
            // Check if this member is the team leader
            $isTeamLeader = $request->input('team_leader_id') == $key;

            // Create a new member instance
            $member = new Member(); // Initialize the member instance

            // Manually set member properties
            $member->national = $memberData['national'];
            $member->name = $memberData['name'];
            $member->email = $memberData['email'];
            $member->phone_number = $memberData['phone_number'];
            $member->age = $memberData['age'];
            $member->is_new = $memberData['is_new'];
            $member->major_id = $memberData['major_id'];
            $member->organization = $memberData['organization'];
            $member->participant_type = $memberData['participant_type'] ? 'onsite' : 'online'; // Allow null
            $member->study_level_id = $memberData['study_level_id'];
            $member->transportation_id = $memberData['transportation_id'] ?? null; // Allow null
            $member->extra_field = $memberData['national_id_photo'];
            $member->member_role = $isTeamLeader ? 'team_leader' : 'member';
            $member->tshirt_size_id = $memberData['tshirt_size_id'] ?? null; // Allow null

            // Save the member
            $member->save();

            if( $isTeamLeader ) {
                $team->team_leader_id = $member->id;
                $team->save();
            }
            $team->members()->attach($member->id);
        }

        // Return a success response
        return true;
    }
    public function store(StoreTeamRequest $request)
    {
        $team = Team::create($request->all());

        if ($request->input('team_photo', false)) {
            $team->addMedia(storage_path('tmp/uploads/' . basename($request->input('team_photo'))))->toMediaCollection('team_photo');
        }

        return (new TeamResource($team))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Team $team)
    {
        abort_if(Gate::denies('team_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TeamResource($team->load(['team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method']));
    }

    public function update(UpdateTeamRequest $request, Team $team)
    {
        $team->update($request->all());

        return (new TeamResource($team))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Team $team)
    {
        abort_if(Gate::denies('team_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $team->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        $model = new Team();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
