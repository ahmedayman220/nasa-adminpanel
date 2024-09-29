<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTeamRequest;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Http\Requests\updateTeamScoreRequest;
use App\Jobs\AcceptedVirtual;
use App\Jobs\OnsiteAcceptedOnsite;
use App\Jobs\QRandEmailTeamMembersJob;
use App\Models\ActualSolution;
use App\Models\Challenge;
use App\Models\Member;
use App\Models\MentorshipNeeded;
use App\Models\ParticipationMethod;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TeamController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('team_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $user = auth()->user(); // Or use User::find($userId);

            $userChallenge = $user->userUserChallenges()->first();
            $challenges_ids = $userChallenge->userChallenge()->first()->challengeUserChallenges()->get();


            foreach ($challenges_ids as $challenge_id) {
                $teamsForEachChallenge = $challenge_id->challenge()->first()->challengeTeams()->get();
                foreach ($teamsForEachChallenge as $team) {
                    $teamIds[] = $team->id;
                }
            }
//            return response()->json($teamIds);
            // i need display all teams for the user without query
            $query = Team::with(['team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method'])
                ->select(sprintf('%s.*', (new Team)->table));//->whereIn('id', $teamIds);



            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'team_show';
                $editGate = 'team_edit';
                $deleteGate = 'team_delete';
                $crudRoutePart = 'teams';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });


            $table->editColumn('team_name', function ($row) {
                return $row->team_name ? $row->team_name : '';
            });
            $table->addColumn('challenge_title', function ($row) {
                return $row->challenge ? $row->challenge->title : '';
            });

            $table->addColumn('actual_solution_title', function ($row) {
                return $row->actual_solution ? $row->actual_solution->title : '';
            });

            $table->editColumn('project_proposal_url', function ($row) {
                return $row->project_proposal_url ? $row->project_proposal_url : '';
            });
            $table->editColumn('project_video_url', function ($row) {
                return $row->project_video_url ? $row->project_video_url : '';
            });

            $table->editColumn('total_score', function ($row) {
                return $row->total_score ? $row->total_score : '';
            });
            $table->editColumn('status', function ($row) {
//                return $row->status ? Team::STATUS_SELECT[$row->status] : '';
                return $row->status ??  '';
            });

            $table->addColumn('participation_method_title', function ($row) {
                return $row->participation_method ? $row->participation_method->title : '';
            });

            $table->editColumn('limited_capacity', function ($row) {
                return $row->limited_capacity ? 'True' : null;
            });


            $table->editColumn('extra_field', function ($row) {
                return $row->extra_field ? $row->extra_field : '';
            });
            $table->editColumn('change_status', function ($row) {
                $teamID = $row->id;
                return "<form method='POST' class='d-inline' action='" . route('admin.teams.updateTeamStatus') . "'>" .
                    csrf_field() .
                    "<input type='hidden' name='team_id' value='$teamID'>" .
                    "<select class='form-control-sm role-select' name='status' onchange='this.form.submit()'>
                        <option value='0' disabled selected>-- Choose Status --</option>
                        <option value='1'>Rejected</option>
                        <option value='2'>Accepted On Site</option>
                        <option value='3'>Accepted Virtual</option>
                        </select>";
            });

            $table->rawColumns(['actions', 'change_status', 'placeholder', 'team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method', 'limited_capacity', 'members_participated_before']);

            return $table->make(true);
        }

        $members = Member::get();
        $challenges = Challenge::get();
        $actual_solutions = ActualSolution::get();
        $mentorship_neededs = MentorshipNeeded::get();
        $participation_methods = ParticipationMethod::get();
        return view('admin.teams.index', compact('members', 'challenges', 'actual_solutions', 'mentorship_neededs', 'participation_methods'));
    }


    public function create()
    {
        abort_if(Gate::denies('team_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $team_leaders = Member::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $challenges = Challenge::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $actual_solutions = ActualSolution::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mentorship_neededs = MentorshipNeeded::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $participation_methods = ParticipationMethod::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.teams.create', compact('actual_solutions', 'challenges', 'mentorship_neededs', 'participation_methods', 'team_leaders'));
    }

    public function store(StoreTeamRequest $request)
    {
        $team = Team::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $team->id]);
        }

        return redirect()->route('admin.teams.index');
    }

    public function edit(Team $team)
    {
        abort_if(Gate::denies('team_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $team_leaders = Member::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $challenges = Challenge::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $actual_solutions = ActualSolution::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mentorship_neededs = MentorshipNeeded::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $participation_methods = ParticipationMethod::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $team->load('team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method');

        return view('admin.teams.edit', compact('actual_solutions', 'challenges', 'mentorship_neededs', 'participation_methods', 'team', 'team_leaders'));
    }

    public function update(UpdateTeamRequest $request, Team $team)
    {
        $team->update($request->all());

        return redirect()->route('admin.teams.index');
    }

    public function show(Team $team)
    {
        abort_if(Gate::denies('team_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $team->load('team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method');

        return view('admin.teams.show', compact('team'));
    }

    public function updateTeamScore(updateTeamScoreRequest $request, $id)
    {
        // Define Variables
        $relevancy = (int)$request->relevancy;
        $impact = (int)$request->impact;
        $creativity = (int)$request->creativity;
        $proposal = (int)$request->proposal;
        $video = (int)$request->video;
        $sum = $relevancy + $impact + $creativity + $proposal + $video;
        $total_score = $sum / 5;
        // Find and Update
        $team = Team::findorFail($id);
        $team->relevancy = $relevancy;
        $team->impact = $impact;
        $team->creativity = $creativity;
        $team->proposal = $proposal;
        $team->video = $video;
        $team->total_score = $total_score;
        $team->save();

        return back()->with('success', 'score updated successfully');
    }

    public function updateTeamStatus(Request $request)
    {
        $team = Team::find($request->team_id);
        if (!$team) {
            return back()->with('Failed', 'Team not found');
        }
        if ($request->status == 1)
            $status = 'rejected';
        else if ($request->status == 2)
            $status = 'accepted_onsite';
        else if ($request->status == 3)
            $status = 'accepted_virtual';
        else
            return back()->with('Failed', 'status not found');

        $team->update([
            'status' => $status
        ]);
        return back()->with('success', 'Team status updated successfully');
    }

    public function showOnsiteTeams(Request $request)
    {
        if ($request->ajax()) {
            $condition_id = ParticipationMethod::where('title', 'Onsite')->pluck('id')->first();
            $query = Team::with(['team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method'])->select(sprintf('%s.*', (new Team)->table))->where('participation_method_id', $condition_id)->where('status', 'accepted_onsite');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'team_show';
                $editGate = 'team_edit';
                $deleteGate = 'team_delete';
                $crudRoutePart = 'teams';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('uuid', function ($row) {
                return $row->uuid ? $row->uuid : '';
            });
            $table->addColumn('team_leader_name', function ($row) {
                return $row->team_leader ? $row->team_leader->name : '';
            });

            $table->editColumn('team_leader.email', function ($row) {
                return $row->team_leader ? (is_string($row->team_leader) ? $row->team_leader : $row->team_leader->email) : '';
            });
            $table->editColumn('team_name', function ($row) {
                return $row->team_name ? $row->team_name : '';
            });
            $table->addColumn('challenge_title', function ($row) {
                return $row->challenge ? $row->challenge->title : '';
            });

            $table->addColumn('actual_solution_title', function ($row) {
                return $row->actual_solution ? $row->actual_solution->title : '';
            });

            $table->addColumn('mentorship_needed_title', function ($row) {
                return $row->mentorship_needed ? $row->mentorship_needed->title : '';
            });

            $table->addColumn('participation_method_title', function ($row) {
                return $row->participation_method ? $row->participation_method->title : '';
            });

            $table->editColumn('limited_capacity', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->limited_capacity ? 'checked' : null) . '>';
            });
            $table->editColumn('members_participated_before', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->members_participated_before ? 'checked' : null) . '>';
            });
            $table->editColumn('project_proposal_url', function ($row) {
                return $row->project_proposal_url ? $row->project_proposal_url : '';
            });
            $table->editColumn('project_video_url', function ($row) {
                return $row->project_video_url ? $row->project_video_url : '';
            });
            $table->editColumn('team_rating', function ($row) {
                return $row->team_rating ? $row->team_rating : '';
            });
            $table->editColumn('total_score', function ($row) {
                return $row->total_score ? $row->total_score : '';
            });
            $table->editColumn('status', function ($row) {
//                return $row->status ? Team::STATUS_SELECT[$row->status] : '';
                return $row->status ?? '';
            });

            $table->editColumn('extra_field', function ($row) {
                return $row->extra_field ? $row->extra_field : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method', 'limited_capacity', 'members_participated_before']);

            return $table->make(true);
        }

        $members = Member::get();
        $challenges = Challenge::get();
        $actual_solutions = ActualSolution::get();
        $mentorship_neededs = MentorshipNeeded::get();
        $participation_methods = ParticipationMethod::get();
        return view('admin.teams.extra.show-onsite', compact('members', 'challenges', 'actual_solutions', 'mentorship_neededs', 'participation_methods'));
    }

    public function showVirtualTeams(Request $request)
    {
        if ($request->ajax()) {
//            $condition_id = ParticipationMethod::where('title', 'Virtual')->pluck('id')->first();
            $query = Team::with(['team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method'])->select(sprintf('%s.*', (new Team)->table))->where('status', 'accepted_virtual');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'team_show';
                $editGate = 'team_edit';
                $deleteGate = 'team_delete';
                $crudRoutePart = 'teams';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('uuid', function ($row) {
                return $row->uuid ? $row->uuid : '';
            });
            $table->addColumn('team_leader_name', function ($row) {
                return $row->team_leader ? $row->team_leader->name : '';
            });

            $table->editColumn('team_leader.email', function ($row) {
                return $row->team_leader ? (is_string($row->team_leader) ? $row->team_leader : $row->team_leader->email) : '';
            });
            $table->editColumn('team_name', function ($row) {
                return $row->team_name ? $row->team_name : '';
            });
            $table->addColumn('challenge_title', function ($row) {
                return $row->challenge ? $row->challenge->title : '';
            });

            $table->addColumn('actual_solution_title', function ($row) {
                return $row->actual_solution ? $row->actual_solution->title : '';
            });

            $table->addColumn('mentorship_needed_title', function ($row) {
                return $row->mentorship_needed ? $row->mentorship_needed->title : '';
            });

            $table->addColumn('participation_method_title', function ($row) {
                return $row->participation_method ? $row->participation_method->title : '';
            });

            $table->editColumn('limited_capacity', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->limited_capacity ? 'checked' : null) . '>';
            });
            $table->editColumn('members_participated_before', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->members_participated_before ? 'checked' : null) . '>';
            });
            $table->editColumn('project_proposal_url', function ($row) {
                return $row->project_proposal_url ? $row->project_proposal_url : '';
            });
            $table->editColumn('project_video_url', function ($row) {
                return $row->project_video_url ? $row->project_video_url : '';
            });
            $table->editColumn('team_rating', function ($row) {
                return $row->team_rating ? $row->team_rating : '';
            });
            $table->editColumn('total_score', function ($row) {
                return $row->total_score ? $row->total_score : '';
            });
            $table->editColumn('status', function ($row) {
//                return $row->status ? Team::STATUS_SELECT[$row->status] : '';
                return $row->status ?? '';
            });

            $table->editColumn('extra_field', function ($row) {
                return $row->extra_field ? $row->extra_field : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method', 'limited_capacity', 'members_participated_before']);

            return $table->make(true);
        }

        $members = Member::get();
        $challenges = Challenge::get();
        $actual_solutions = ActualSolution::get();
        $mentorship_neededs = MentorshipNeeded::get();
        $participation_methods = ParticipationMethod::get();
        return view('admin.teams.extra.show-virtual', compact('members', 'challenges', 'actual_solutions', 'mentorship_neededs', 'participation_methods'));
    }

    public function showRejectedTeams(Request $request)
    {
        if ($request->ajax()) {
            $query = Team::with(['team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method'])->select(sprintf('%s.*', (new Team)->table))->where('status', 'rejected');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'team_show';
                $editGate = 'team_edit';
                $deleteGate = 'team_delete';
                $crudRoutePart = 'teams';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('uuid', function ($row) {
                return $row->uuid ? $row->uuid : '';
            });
            $table->addColumn('team_leader_name', function ($row) {
                return $row->team_leader ? $row->team_leader->name : '';
            });

            $table->editColumn('team_leader.email', function ($row) {
                return $row->team_leader ? (is_string($row->team_leader) ? $row->team_leader : $row->team_leader->email) : '';
            });
            $table->editColumn('team_name', function ($row) {
                return $row->team_name ? $row->team_name : '';
            });
            $table->addColumn('challenge_title', function ($row) {
                return $row->challenge ? $row->challenge->title : '';
            });

            $table->addColumn('actual_solution_title', function ($row) {
                return $row->actual_solution ? $row->actual_solution->title : '';
            });

            $table->addColumn('mentorship_needed_title', function ($row) {
                return $row->mentorship_needed ? $row->mentorship_needed->title : '';
            });

            $table->addColumn('participation_method_title', function ($row) {
                return $row->participation_method ? $row->participation_method->title : '';
            });


            $table->editColumn('limited_capacity', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->limited_capacity ? 'checked' : null) . '>';
            });
            $table->editColumn('members_participated_before', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->members_participated_before ? 'checked' : null) . '>';
            });
            $table->editColumn('project_proposal_url', function ($row) {
                return $row->project_proposal_url ? $row->project_proposal_url : '';
            });
            $table->editColumn('project_video_url', function ($row) {
                return $row->project_video_url ? $row->project_video_url : '';
            });
            $table->editColumn('team_rating', function ($row) {
                return $row->team_rating ? $row->team_rating : '';
            });
            $table->editColumn('total_score', function ($row) {
                return $row->total_score ? $row->total_score : '';
            });
            $table->editColumn('status', function ($row) {
//                return $row->status ? Team::STATUS_SELECT[$row->status] : '';
                return $row->status ?? '';

            });

            $table->editColumn('extra_field', function ($row) {
                return $row->extra_field ? $row->extra_field : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method', 'limited_capacity', 'members_participated_before']);

            return $table->make(true);
        }

        $members = Member::get();
        $challenges = Challenge::get();
        $actual_solutions = ActualSolution::get();
        $mentorship_neededs = MentorshipNeeded::get();
        $participation_methods = ParticipationMethod::get();
        return view('admin.teams.extra.show-rejected', compact('members', 'challenges', 'actual_solutions', 'mentorship_neededs', 'participation_methods'));
    }

    public function showAll(Request $request){
        if ($request->ajax()) {
            $query = Team::with(['team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method'])->select(sprintf('%s.*', (new Team)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'team_show';
                $editGate = 'team_edit';
                $deleteGate = 'team_delete';
                $crudRoutePart = 'teams';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('uuid', function ($row) {
                return $row->uuid ? $row->uuid : '';
            });
            $table->addColumn('team_leader_name', function ($row) {
                return $row->team_leader ? $row->team_leader->name : '';
            });

            $table->editColumn('team_leader.email', function ($row) {
                return $row->team_leader ? (is_string($row->team_leader) ? $row->team_leader : $row->team_leader->email) : '';
            });
            $table->editColumn('team_name', function ($row) {
                return $row->team_name ? $row->team_name : '';
            });
            $table->addColumn('challenge_title', function ($row) {
                return $row->challenge ? $row->challenge->title : '';
            });

            $table->addColumn('actual_solution_title', function ($row) {
                return $row->actual_solution ? $row->actual_solution->title : '';
            });

            $table->addColumn('mentorship_needed_title', function ($row) {
                return $row->mentorship_needed ? $row->mentorship_needed->title : '';
            });

            $table->addColumn('participation_method_title', function ($row) {
                return $row->participation_method ? $row->participation_method->title : '';
            });


            $table->editColumn('limited_capacity', function ($row) {
                return $row->limited_capacity ? 'Yes' : 'No';
            });
            $table->editColumn('members_participated_before', function ($row) {
                return $row->members_participated_before ? 'Yes' : 'No';
            });
            $table->editColumn('project_proposal_url', function ($row) {
                return $row->project_proposal_url ? $row->project_proposal_url : '';
            });
            $table->editColumn('project_video_url', function ($row) {
                return $row->project_video_url ? $row->project_video_url : '';
            });
            $table->editColumn('team_rating', function ($row) {
                return $row->team_rating ? $row->team_rating : '';
            });
            $table->editColumn('total_score', function ($row) {
                return $row->total_score ? $row->total_score : '';
            });
            $table->editColumn('status', function ($row) {
//                return $row->status ? Team::STATUS_SELECT[$row->status] : '';
                return $row->status ?? '';

            });

            $table->editColumn('comment', function ($row) {
                return $row->comment ?? '';
            });


            $table->editColumn('extra_field', function ($row) {
                return $row->extra_field ? $row->extra_field : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method', 'limited_capacity', 'members_participated_before']);

            return $table->make(true);
        }

        $members = Member::get();
        $challenges = Challenge::get();
        $actual_solutions = ActualSolution::get();
        $mentorship_neededs = MentorshipNeeded::get();
        $participation_methods = ParticipationMethod::get();
        return view('admin.teams.extra.show-all', compact('members', 'challenges', 'actual_solutions', 'mentorship_neededs', 'participation_methods'));
    }

    public function generateAndEmail(Request $request, Team $team)
    {
        foreach ($request->ids as $id){
            $teamObject = $team->findorFail($id);
            if($teamObject->participation_method->title == 'Onsite' && $teamObject->status == 'accepted_onsite'){
                //for onsite participated teams
                dispatch(new OnsiteAcceptedOnsite($teamObject->members,$request->host(),$teamObject));
            } else{
                // for virtual participated teams
                dispatch(new AcceptedVirtual($teamObject->members,$request->host(),$teamObject));
            }
        }
        session()->flash('success','Your request is processing please wait..');
        return response(null);
    }

    public function destroy(Team $team)
    {
        abort_if(Gate::denies('team_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $team->delete();

        return back();
    }

    public function massDestroy(MassDestroyTeamRequest $request)
    {
        $teams = Team::find(request('ids'));

        foreach ($teams as $team) {
            $team->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('team_create') && Gate::denies('team_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Team();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
