<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyChallengeCategoryRequest;
use App\Http\Requests\StoreChallengeCategoryRequest;
use App\Http\Requests\UpdateChallengeCategoryRequest;
use App\Models\ChallengeCategory;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ChallengeCategoriesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('challenge_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ChallengeCategory::with(['created_by'])->select(sprintf('%s.*', (new ChallengeCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'challenge_category_show';
                $editGate      = 'challenge_category_edit';
                $deleteGate    = 'challenge_category_delete';
                $crudRoutePart = 'challenge-categories';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.challengeCategories.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('challenge_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.challengeCategories.create');
    }

    public function store(StoreChallengeCategoryRequest $request)
    {
        $challengeCategory = ChallengeCategory::create($request->all());

        return redirect()->route('admin.challenge-categories.index');
    }

    public function edit(ChallengeCategory $challengeCategory)
    {
        abort_if(Gate::denies('challenge_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $challengeCategory->load('created_by');

        return view('admin.challengeCategories.edit', compact('challengeCategory'));
    }

    public function update(UpdateChallengeCategoryRequest $request, ChallengeCategory $challengeCategory)
    {
        $challengeCategory->update($request->all());

        return redirect()->route('admin.challenge-categories.index');
    }

    public function show(ChallengeCategory $challengeCategory)
    {
        abort_if(Gate::denies('challenge_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $challengeCategory->load('created_by', 'categoryChallenges');

        return view('admin.challengeCategories.show', compact('challengeCategory'));
    }

    public function destroy(ChallengeCategory $challengeCategory)
    {
        abort_if(Gate::denies('challenge_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $challengeCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyChallengeCategoryRequest $request)
    {
        $challengeCategories = ChallengeCategory::find(request('ids'));

        foreach ($challengeCategories as $challengeCategory) {
            $challengeCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
