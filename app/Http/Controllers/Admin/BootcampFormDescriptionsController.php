<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBootcampFormDescriptionRequest;
use App\Http\Requests\StoreBootcampFormDescriptionRequest;
use App\Http\Requests\UpdateBootcampFormDescriptionRequest;
use App\Models\BootcampFormDescription;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BootcampFormDescriptionsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bootcamp_form_description_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BootcampFormDescription::with(['created_by'])->select(sprintf('%s.*', (new BootcampFormDescription)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'bootcamp_form_description_show';
                $editGate      = 'bootcamp_form_description_edit';
                $deleteGate    = 'bootcamp_form_description_delete';
                $crudRoutePart = 'bootcamp-form-descriptions';

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
            $table->editColumn('section_1_title', function ($row) {
                return $row->section_1_title ? $row->section_1_title : '';
            });
            $table->editColumn('national_id_front_description', function ($row) {
                return $row->national_id_front_description ? $row->national_id_front_description : '';
            });
            $table->editColumn('national_id_back_description', function ($row) {
                return $row->national_id_back_description ? $row->national_id_back_description : '';
            });
            $table->editColumn('section_2_title', function ($row) {
                return $row->section_2_title ? $row->section_2_title : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.bootcampFormDescriptions.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('bootcamp_form_description_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bootcampFormDescriptions.create');
    }

    public function store(StoreBootcampFormDescriptionRequest $request)
    {
        $bootcampFormDescription = BootcampFormDescription::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bootcampFormDescription->id]);
        }

        return redirect()->route('admin.bootcamp-form-descriptions.index');
    }

    public function edit(BootcampFormDescription $bootcampFormDescription)
    {
        abort_if(Gate::denies('bootcamp_form_description_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcampFormDescription->load('created_by');

        return view('admin.bootcampFormDescriptions.edit', compact('bootcampFormDescription'));
    }

    public function update(UpdateBootcampFormDescriptionRequest $request, BootcampFormDescription $bootcampFormDescription)
    {
        $bootcampFormDescription->update($request->all());

        return redirect()->route('admin.bootcamp-form-descriptions.index');
    }

    public function show(BootcampFormDescription $bootcampFormDescription)
    {
        abort_if(Gate::denies('bootcamp_form_description_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcampFormDescription->load('created_by');

        return view('admin.bootcampFormDescriptions.show', compact('bootcampFormDescription'));
    }

    public function destroy(BootcampFormDescription $bootcampFormDescription)
    {
        abort_if(Gate::denies('bootcamp_form_description_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcampFormDescription->delete();

        return back();
    }

    public function massDestroy(MassDestroyBootcampFormDescriptionRequest $request)
    {
        $bootcampFormDescriptions = BootcampFormDescription::find(request('ids'));

        foreach ($bootcampFormDescriptions as $bootcampFormDescription) {
            $bootcampFormDescription->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('bootcamp_form_description_create') && Gate::denies('bootcamp_form_description_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BootcampFormDescription();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
