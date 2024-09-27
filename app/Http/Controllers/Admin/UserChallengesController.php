<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserChallengeRequest;
use App\Http\Requests\StoreUserChallengeRequest;
use App\Http\Requests\UpdateUserChallengeRequest;
use App\Models\Challenge;
use App\Models\User;
use App\Models\UserChallenge;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserChallengesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('user_challenge_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserChallenge::with(['users', 'challenges'])->select(sprintf('%s.*', (new UserChallenge)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_challenge_show';
                $editGate      = 'user_challenge_edit';
                $deleteGate    = 'user_challenge_delete';
                $crudRoutePart = 'user-challenges';

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
            $table->editColumn('user', function ($row) {
                $labels = [];
                foreach ($row->users as $user) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $user->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('challenge', function ($row) {
                $labels = [];
                foreach ($row->challenges as $challenge) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $challenge->title);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'challenge']);

            return $table->make(true);
        }

        $users      = User::get();
        $challenges = Challenge::get();

        return view('admin.userChallenges.index', compact('users', 'challenges'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_challenge_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id');

        $challenges = Challenge::pluck('title', 'id');

        return view('admin.userChallenges.create', compact('challenges', 'users'));
    }

    public function store(StoreUserChallengeRequest $request)
    {
        $userChallenge = UserChallenge::create($request->all());
        $userChallenge->users()->sync($request->input('users', []));
        $userChallenge->challenges()->sync($request->input('challenges', []));

        return redirect()->route('admin.user-challenges.index');
    }

    public function edit(UserChallenge $userChallenge)
    {
        abort_if(Gate::denies('user_challenge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id');

        $challenges = Challenge::pluck('title', 'id');

        $userChallenge->load('users', 'challenges');

        return view('admin.userChallenges.edit', compact('challenges', 'userChallenge', 'users'));
    }

    public function update(UpdateUserChallengeRequest $request, UserChallenge $userChallenge)
    {
        $userChallenge->update($request->all());
        $userChallenge->users()->sync($request->input('users', []));
        $userChallenge->challenges()->sync($request->input('challenges', []));

        return redirect()->route('admin.user-challenges.index');
    }

    public function show(UserChallenge $userChallenge)
    {
        abort_if(Gate::denies('user_challenge_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userChallenge->load('users', 'challenges');

        return view('admin.userChallenges.show', compact('userChallenge'));
    }

    public function destroy(UserChallenge $userChallenge)
    {
        abort_if(Gate::denies('user_challenge_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userChallenge->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserChallengeRequest $request)
    {
        $userChallenges = UserChallenge::find(request('ids'));

        foreach ($userChallenges as $userChallenge) {
            $userChallenge->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
