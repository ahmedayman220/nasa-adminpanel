<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\StorehackathonRegistrationRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Http\Resources\Admin\TeamResource;
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
        // Begin a transaction to ensure data integrity
        DB::beginTransaction();

        try {
            // Create the team
            $teamData = $request->only([
                'team_leader_id', 'team_name', 'challenge_id',
                'actual_solution_id', 'mentorship_needed_id', 'participation_method_id',
                'limited_capacity', 'members_participated_before', 'project_proposal_url',
                'project_video_url', 'team_rating', 'total_score', 'submission_date', 'extra_field'
            ]);

            $team = Team::create($teamData);

            // Create members and associate them with the team
            foreach ($request->input('members') as $memberData) {
                $memberData['team_id'] = $team->id; // Assuming there's a 'team_id' column in the members table
                $member = Member::create($memberData);
            }

            // Commit the transaction
            DB::commit();

            return (new TeamResource($team))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
        } catch (\Exception $e) {
            // Rollback the transaction on failure
            DB::rollBack();
            return response()->json(['error' => 'Registration failed: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
