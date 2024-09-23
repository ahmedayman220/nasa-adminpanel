<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTeamRequest;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
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
            $query = Team::with(['team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method'])->select(sprintf('%s.*', (new Team)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'team_show';
                $editGate      = 'team_edit';
                $deleteGate    = 'team_delete';
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

            $table->editColumn('team_photo', function ($row) {
                if ($photo = $row->team_photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
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
                return $row->status ? Team::STATUS_SELECT[$row->status] : '';
            });

            $table->editColumn('extra_field', function ($row) {
                return $row->extra_field ? $row->extra_field : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method', 'team_photo', 'limited_capacity', 'members_participated_before']);

            return $table->make(true);
        }

        $members               = Member::get();
        $challenges            = Challenge::get();
        $actual_solutions      = ActualSolution::get();
        $mentorship_neededs    = MentorshipNeeded::get();
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

        if ($request->input('team_photo', false)) {
            $team->addMedia(storage_path('tmp/uploads/' . basename($request->input('team_photo'))))->toMediaCollection('team_photo');
        }

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

        if ($request->input('team_photo', false)) {
            if (! $team->team_photo || $request->input('team_photo') !== $team->team_photo->file_name) {
                if ($team->team_photo) {
                    $team->team_photo->delete();
                }
                $team->addMedia(storage_path('tmp/uploads/' . basename($request->input('team_photo'))))->toMediaCollection('team_photo');
            }
        } elseif ($team->team_photo) {
            $team->team_photo->delete();
        }

        return redirect()->route('admin.teams.index');
    }

    public function show(Team $team)
    {
        abort_if(Gate::denies('team_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $team->load('team_leader', 'challenge', 'actual_solution', 'mentorship_needed', 'participation_method');

        return view('admin.teams.show', compact('team'));
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

        $model         = new Team();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
