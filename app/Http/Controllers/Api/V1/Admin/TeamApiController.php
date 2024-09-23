<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\StorehackathonRegistrationRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Http\Resources\Admin\TeamResource;
use App\Models\Member;
use App\Models\Team;
use Gate;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('team_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TeamResource(Team::with(['team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method'])->get());
    }

    public function HackathonRegistration(StorehackathonRegistrationRequest $request)
    {
        // Step 1: Store the team
        $teamRequest = new StoreTeamRequest($request->only('team_name', 'challenge_id', 'mentorship_needed_id', 'participation_method_id', 'description'));
        $team = $this->store($teamRequest)->getData()->data; // Assuming this returns the created team resource

        // Step 2: Store the members
        $membersData = $request->input('members'); // Assuming the members are passed in the request
        foreach ($membersData as $memberData) {
            $memberRequest = Member::create($memberData);
            $this->store($memberRequest);
            // After storing each member, you may want to attach it to the team
            $team->members()->attach($memberRequest->id); // Attach the member to the team
        }

        return response()->json([
            'team' => $team,
            'message' => 'Team and members registered successfully.'
        ], Response::HTTP_CREATED);
    }
        // Update the team leader ID if set
        if ($leaderId) {
            $team->update(['team_leader_id' => $leaderId]);
        }

        // Return a success response
        return response()->json([
            'message' => 'Registration successful',
            'team' => $team,
            'members' => $team->members,
        ], Response::HTTP_CREATED);
    }

    public function store(StoreTeamRequest $request)
    {
        $team = Team::create($request->all());

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
}
