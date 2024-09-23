<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDifficultyLevelRequest;
use App\Http\Requests\StoreDifficultyLevelRequest;
use App\Http\Requests\UpdateDifficultyLevelRequest;
use App\Models\DifficultyLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DifficultyLevelController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('difficulty_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $difficultyLevels = DifficultyLevel::all();

        return view('admin.difficultyLevels.index', compact('difficultyLevels'));
    }

    public function create()
    {
        abort_if(Gate::denies('difficulty_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.difficultyLevels.create');
    }

    public function store(StoreDifficultyLevelRequest $request)
    {
        $difficultyLevel = DifficultyLevel::create($request->all());

        return redirect()->route('admin.difficulty-levels.index');
    }

    public function edit(DifficultyLevel $difficultyLevel)
    {
        abort_if(Gate::denies('difficulty_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.difficultyLevels.edit', compact('difficultyLevel'));
    }

    public function update(UpdateDifficultyLevelRequest $request, DifficultyLevel $difficultyLevel)
    {
        $difficultyLevel->update($request->all());

        return redirect()->route('admin.difficulty-levels.index');
    }

    public function show(DifficultyLevel $difficultyLevel)
    {
        abort_if(Gate::denies('difficulty_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $difficultyLevel->load('difficultyLevelChallenges');

        return view('admin.difficultyLevels.show', compact('difficultyLevel'));
    }

    public function destroy(DifficultyLevel $difficultyLevel)
    {
        abort_if(Gate::denies('difficulty_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $difficultyLevel->delete();

        return back();
    }

    public function massDestroy(MassDestroyDifficultyLevelRequest $request)
    {
        $difficultyLevels = DifficultyLevel::find(request('ids'));

        foreach ($difficultyLevels as $difficultyLevel) {
            $difficultyLevel->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
