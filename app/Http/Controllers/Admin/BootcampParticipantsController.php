<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBootcampParticipantRequest;
use App\Http\Requests\StoreBootcampParticipantRequest;
use App\Http\Requests\UpdateBootcampParticipantRequest;
use App\Models\BootcampParticipant;
use App\Models\EducationLevel;
use App\Models\MentionYourField;
use App\Models\User;
use App\Models\Workshop;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\BootcampHelper;
use App\Models\ParticipantWorkshopPreference;

class BootcampParticipantsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bootcamp_participant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BootcampParticipant::with(['educational_level', 'field_of_study', 'first_priority', 'second_priority', 'third_priority', 'created_by'])->select(sprintf('%s.*', (new BootcampParticipant)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'bootcamp_participant_show';
                $editGate      = 'bootcamp_participant_edit';
                $deleteGate    = 'bootcamp_participant_delete';
                $crudRoutePart = 'bootcamp-participants';

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
            $table->editColumn('name_en', function ($row) {
                return $row->name_en ? $row->name_en : '';
            });
            $table->editColumn('name_ar', function ($row) {
                return $row->name_ar ? $row->name_ar : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('age', function ($row) {
                return $row->age ? $row->age : '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->addColumn('educational_level_title', function ($row) {
                return $row->educational_level ? $row->educational_level->title : '';
            });

            $table->addColumn('field_of_study_title', function ($row) {
                return $row->field_of_study ? $row->field_of_study->title : '';
            });

            $table->editColumn('educational_institute', function ($row) {
                return $row->educational_institute ? $row->educational_institute : '';
            });
            $table->editColumn('graduation_year', function ($row) {
                return $row->graduation_year ? $row->graduation_year : '';
            });
            $table->editColumn('position', function ($row) {
                return $row->position ? $row->position : '';
            });
            $table->editColumn('national', function ($row) {
                return $row->national ? $row->national : '';
            });
            $table->editColumn('national_id_front', function ($row) {
                if ($photo = $row->national_id_front) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('national_id_back', function ($row) {
                if ($photo = $row->national_id_back) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('is_participated', function ($row) {
                return $row->is_participated ? BootcampParticipant::IS_PARTICIPATED_RADIO[$row->is_participated] : '';
            });
            $table->editColumn('participated_year', function ($row) {
                return $row->participated_year ? $row->participated_year : '';
            });
            $table->editColumn('is_attend_formation_activity', function ($row) {
                return $row->is_attend_formation_activity ? BootcampParticipant::IS_ATTEND_FORMATION_ACTIVITY_RADIO[$row->is_attend_formation_activity] : '';
            });
            $table->addColumn('first_priority_title', function ($row) {
                return $row->first_priority ? $row->first_priority->title : '';
            });

            $table->addColumn('second_priority_title', function ($row) {
                return $row->second_priority ? $row->second_priority->title : '';
            });

            $table->addColumn('third_priority_title', function ($row) {
                return $row->third_priority ? $row->third_priority->title : '';
            });

            $table->editColumn('why_this_workshop', function ($row) {
                return $row->why_this_workshop ? $row->why_this_workshop : '';
            });
            $table->editColumn('is_have_team', function ($row) {
                return $row->is_have_team ? BootcampParticipant::IS_HAVE_TEAM_RADIO[$row->is_have_team] : '';
            });
            $table->editColumn('comment', function ($row) {
                return $row->comment ? $row->comment : '';
            });
            $table->editColumn('year', function ($row) {
                return $row->year ? $row->year : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'educational_level', 'field_of_study', 'national_id_front', 'national_id_back', 'first_priority', 'second_priority', 'third_priority']);

            return $table->make(true);
        }

        $education_levels    = EducationLevel::get();
        $mention_your_fields = MentionYourField::get();
        $workshops           = Workshop::get();
        $users               = User::get();

        return view('admin.bootcampParticipants.index', compact('education_levels', 'mention_your_fields', 'workshops', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('bootcamp_participant_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educational_levels = EducationLevel::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_of_studies = MentionYourField::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $first_priorities = Workshop::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $second_priorities = Workshop::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $third_priorities = Workshop::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bootcampParticipants.create', compact('educational_levels', 'field_of_studies', 'first_priorities', 'second_priorities', 'third_priorities'));
    }

    public function store(StoreBootcampParticipantRequest $request)
    {
        $bootcampParticipant = BootcampParticipant::create($request->all());

        if (isset($bootcampParticipant->first_priority_id)) {
            ParticipantWorkshopPreference::create([
                'bootcamp_participant_id' => $bootcampParticipant->id, // Assuming 'id' is the participant ID
                'workshop_id' => $bootcampParticipant->first_priority_id,
                'preference_order' => 1,
            ]);
        }

        if (isset($bootcampParticipant->second_priority_id)) {
            ParticipantWorkshopPreference::create([
                'bootcamp_participant_id' => $bootcampParticipant->id, // Assuming 'id' is the participant ID
                'workshop_id' => $bootcampParticipant->second_priority_id,
                'preference_order' => 2,
            ]);
        }

        if (isset($bootcampParticipant->third_priority_id)) {
            ParticipantWorkshopPreference::create([
                'bootcamp_participant_id' => $bootcampParticipant->id, // Assuming 'id' is the participant ID
                'workshop_id' => $bootcampParticipant->third_priority_id,
                'preference_order' => 3,
            ]);
        }


        BootcampHelper::checkAvailability($bootcampParticipant->id);
//        $result = BootcampHelper::checkAvailability(3);


        if ($request->input('national_id_front', false)) {
            $bootcampParticipant->addMedia(storage_path('tmp/uploads/' . basename($request->input('national_id_front'))))->toMediaCollection('national_id_front');
        }

        if ($request->input('national_id_back', false)) {
            $bootcampParticipant->addMedia(storage_path('tmp/uploads/' . basename($request->input('national_id_back'))))->toMediaCollection('national_id_back');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bootcampParticipant->id]);
        }

        return redirect()->route('admin.bootcamp-participants.index');
    }

    public function edit(BootcampParticipant $bootcampParticipant)
    {
        abort_if(Gate::denies('bootcamp_participant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educational_levels = EducationLevel::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_of_studies = MentionYourField::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $first_priorities = Workshop::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $second_priorities = Workshop::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $third_priorities = Workshop::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bootcampParticipant->load('educational_level', 'field_of_study', 'first_priority', 'second_priority', 'third_priority', 'created_by');

        return view('admin.bootcampParticipants.edit', compact('bootcampParticipant', 'educational_levels', 'field_of_studies', 'first_priorities', 'second_priorities', 'third_priorities'));
    }

    public function update(UpdateBootcampParticipantRequest $request, BootcampParticipant $bootcampParticipant)
    {
        $bootcampParticipant->update($request->all());

        if ($request->input('national_id_front', false)) {
            if (! $bootcampParticipant->national_id_front || $request->input('national_id_front') !== $bootcampParticipant->national_id_front->file_name) {
                if ($bootcampParticipant->national_id_front) {
                    $bootcampParticipant->national_id_front->delete();
                }
                $bootcampParticipant->addMedia(storage_path('tmp/uploads/' . basename($request->input('national_id_front'))))->toMediaCollection('national_id_front');
            }
        } elseif ($bootcampParticipant->national_id_front) {
            $bootcampParticipant->national_id_front->delete();
        }

        if ($request->input('national_id_back', false)) {
            if (! $bootcampParticipant->national_id_back || $request->input('national_id_back') !== $bootcampParticipant->national_id_back->file_name) {
                if ($bootcampParticipant->national_id_back) {
                    $bootcampParticipant->national_id_back->delete();
                }
                $bootcampParticipant->addMedia(storage_path('tmp/uploads/' . basename($request->input('national_id_back'))))->toMediaCollection('national_id_back');
            }
        } elseif ($bootcampParticipant->national_id_back) {
            $bootcampParticipant->national_id_back->delete();
        }

        return redirect()->route('admin.bootcamp-participants.index');
    }

    public function show(BootcampParticipant $bootcampParticipant)
    {
        abort_if(Gate::denies('bootcamp_participant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcampParticipant->load('educational_level', 'field_of_study', 'first_priority', 'second_priority', 'third_priority', 'created_by', 'bootcampParticipantParticipantWorkshopAssignments', 'bootcampParticipantParticipantWorkshopPreferences', 'bootcampParticipantBootcampAttendees', 'bootcampParticipantQrCodes', 'bootcampParticipantEmailEmails');

        return view('admin.bootcampParticipants.show', compact('bootcampParticipant'));
    }

    public function destroy(BootcampParticipant $bootcampParticipant)
    {
        abort_if(Gate::denies('bootcamp_participant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bootcampParticipant->delete();

        return back();
    }

    public function massDestroy(MassDestroyBootcampParticipantRequest $request)
    {
        $bootcampParticipants = BootcampParticipant::find(request('ids'));

        foreach ($bootcampParticipants as $bootcampParticipant) {
            $bootcampParticipant->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('bootcamp_participant_create') && Gate::denies('bootcamp_participant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BootcampParticipant();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
