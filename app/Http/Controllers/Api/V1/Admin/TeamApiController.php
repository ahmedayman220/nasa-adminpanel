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
        // Generate a unique 4-digit UUID for the team

        // Create a new team with the provided data
        $team = Team::create([
            'team_name' => $request->input('team_name'),
            'challenge_id' => $request->input('challenge_id'),
            'actual_solution_id' => $request->input('actual_solution_id'),
            'mentorship_needed_id' => $request->input('mentorship_needed_id'),
            'participation_method_id' => $request->input('participation_method_id'),
            'limited_capacity' => $request->input('limited_capacity'),
            'members_participated_before' => $request->input('members_participated_before'),
            'project_proposal_url' => $request->input('project_proposal_url'),
            'project_video_url' => $request->input('project_video_url'),
        ]);

        $leaderId = null; // Initialize team leader ID

        // Iterate over each member from the request
        foreach ($request->input('members') as $memberData) {
            // Ensure the 'id' key exists to handle existing members
            if (isset($memberData['id'])) {
                // Retrieve or create the member based on the ID
                $member = Member::find($memberData['id']) ?? new Member();

                // Update the member with provided data
                $member->fill($memberData);
                $member->save();

                // Handle member photo upload if available
                if ($request->hasFile("members.{$member->id}.national_id_photo")) {
                    $member->addMedia($request->file("members.{$member->id}.national_id_photo"))
                        ->toMediaCollection('national_id_photos');
                }

                // Check if this member is the team leader
                if ($memberData['id'] == $request->input('team_leader_id')) {
                    $leaderId = $member->id;
                }
            } else {
                // Handle the creation of a new member if ID is not present
                $member = new Member($memberData);
                $member->save();

                // Handle member photo upload if available
                if ($request->hasFile("members.{$member->id}.national_id_photo")) {
                    $member->addMedia($request->file("members.{$member->id}.national_id_photo"))
                        ->toMediaCollection('national_id_photos');
                }

                // Check if this new member is the team leader
                if ($request->input('team_leader_id') == $member->id) {
                    $leaderId = $member->id;
                }
            }

            // Associate the member with the team if required (if you're tracking team members in a pivot table)
            $team->members()->attach($member->id);
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
