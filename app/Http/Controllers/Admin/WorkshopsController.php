<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyWorkshopRequest;
use App\Http\Requests\StoreWorkshopRequest;
use App\Http\Requests\UpdateWorkshopRequest;
use App\Models\User;
use App\Models\Workshop;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WorkshopsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('workshop_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Workshop::with(['created_by'])->select(sprintf('%s.*', (new Workshop)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'workshop_show';
                $editGate = 'workshop_edit';
                $deleteGate = 'workshop_delete';
                $crudRoutePart = 'workshops';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                // Get current page and page length from the request
                $start = request()->input('start', 0);

                // Increment the index based on current page
                static $index = 0;
                return ++$index + $start;
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->addColumn('first_priority_confirmation', function ($row) {
                return $row->firstPriorityBootcampParticipants()
                    ->whereHas('emailBootcampConfirmations') // or ->whereHas('nationalBootcampConfirmations') based on your requirement
                    ->count();
            });

            $table->addColumn('attended_formation_activity', function ($row) {
                return $row->firstPriorityBootcampParticipants()
                    ->where('is_attend_formation_activity', '1') // Check if attended the team formation activity
                    ->whereHas('emailBootcampConfirmations') // or ->whereHas('nationalBootcampConfirmations') based on your requirement
                    ->count();
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.workshops.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('workshop_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.workshops.create');
    }

    public function store(StoreWorkshopRequest $request)
    {
        $workshop = Workshop::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $workshop->id]);
        }

        return redirect()->route('admin.workshops.index');
    }

    public function edit(Workshop $workshop)
    {
        abort_if(Gate::denies('workshop_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workshop->load('created_by');

        return view('admin.workshops.edit', compact('workshop'));
    }

    public function update(UpdateWorkshopRequest $request, Workshop $workshop)
    {
        $workshop->update($request->all());

        return redirect()->route('admin.workshops.index');
    }

    public function show(Workshop $workshop)
    {
        abort_if(Gate::denies('workshop_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workshop->load(
            'created_by',
            'workshopWorkshopSchedules',
            'workshopParticipantWorkshopPreferences',
            'firstPriorityBootcampParticipants' => function ($query) {$query->whereHas('nationalBootcampConfirmations');},
            'secondPriorityBootcampParticipants', 'thirdPriorityBootcampParticipants')
        return view('admin.workshops.show', compact('workshop'));
    }

    public function destroy(Workshop $workshop)
    {
        abort_if(Gate::denies('workshop_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workshop->delete();

        return back();
    }

    public function massDestroy(MassDestroyWorkshopRequest $request)
    {
        $workshops = Workshop::find(request('ids'));

        foreach ($workshops as $workshop) {
            $workshop->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('workshop_create') && Gate::denies('workshop_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Workshop();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
