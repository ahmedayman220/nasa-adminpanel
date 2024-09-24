<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyChallengeRequest;
use App\Http\Requests\StoreChallengeRequest;
use App\Http\Requests\UpdateChallengeRequest;
use App\Models\Challenge;
use App\Models\ChallengeCategory;
use App\Models\DifficultyLevel;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ChallengesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('challenge_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Challenge::with(['category', 'difficulty_level', 'created_by'])->select(sprintf('%s.*', (new Challenge)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'challenge_show';
                $editGate      = 'challenge_edit';
                $deleteGate    = 'challenge_delete';
                $crudRoutePart = 'challenges';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->name : '';
            });

            $table->editColumn('extra_field', function ($row) {
                return $row->extra_field ? $row->extra_field : '';
            });
            $table->addColumn('difficulty_level_name', function ($row) {
                return $row->difficulty_level ? $row->difficulty_level->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'category', 'difficulty_level']);

            return $table->make(true);
        }

        $challenge_categories = ChallengeCategory::get();
        $difficulty_levels    = DifficultyLevel::get();
        $users                = User::get();

        return view('admin.challenges.index', compact('challenge_categories', 'difficulty_levels', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('challenge_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ChallengeCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $difficulty_levels = DifficultyLevel::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.challenges.create', compact('categories', 'difficulty_levels'));
    }

    public function store(StoreChallengeRequest $request)
    {
        $challenge = Challenge::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $challenge->id]);
        }

        return redirect()->route('admin.challenges.index');
    }

    public function edit(Challenge $challenge)
    {
        abort_if(Gate::denies('challenge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ChallengeCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $difficulty_levels = DifficultyLevel::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $challenge->load('category', 'difficulty_level', 'created_by');

        return view('admin.challenges.edit', compact('categories', 'challenge', 'difficulty_levels'));
    }

    public function update(UpdateChallengeRequest $request, Challenge $challenge)
    {
        $challenge->update($request->all());

        return redirect()->route('admin.challenges.index');
    }

    public function show(Challenge $challenge)
    {
        abort_if(Gate::denies('challenge_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $challenge->load('category', 'difficulty_level', 'created_by', 'challengeTeams');

        return view('admin.challenges.show', compact('challenge'));
    }

    public function destroy(Challenge $challenge)
    {
        abort_if(Gate::denies('challenge_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $challenge->delete();

        return back();
    }

    public function massDestroy(MassDestroyChallengeRequest $request)
    {
        $challenges = Challenge::find(request('ids'));

        foreach ($challenges as $challenge) {
            $challenge->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('challenge_create') && Gate::denies('challenge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Challenge();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
