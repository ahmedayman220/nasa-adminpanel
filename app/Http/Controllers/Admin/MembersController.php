<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMemberRequest;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Major;
use App\Models\Member;
use App\Models\QrCode;
use App\Models\StudyLevelss;
use App\Models\Transportation;
use App\Models\TshirtSize;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MembersController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('member_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Member::with(['major', 'study_level', 'tshirt_size', 'qr_code', 'transportation', 'created_by'])->select(sprintf('%s.*', (new Member)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'member_show';
                $editGate      = 'member_edit';
                $deleteGate    = 'member_delete';
                $crudRoutePart = 'members';

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
            $table->editColumn('national', function ($row) {
                return $row->national ? $row->national : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->editColumn('age', function ($row) {
                return $row->age ? $row->age : '';
            });

            $table->editColumn('is_new', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_new ? 'checked' : null) . '>';
            });
            $table->addColumn('major_title', function ($row) {
                return $row->major ? $row->major->title : '';
            });

            $table->editColumn('organization', function ($row) {
                return $row->organization ? $row->organization : '';
            });
            $table->editColumn('participant_type', function ($row) {
                return $row->participant_type ? Member::PARTICIPANT_TYPE_SELECT[$row->participant_type] : '';
            });
            $table->addColumn('study_level_title', function ($row) {
                return $row->study_level ? $row->study_level->title : '';
            });

            $table->addColumn('tshirt_size_title', function ($row) {
                return $row->tshirt_size ? $row->tshirt_size->title : '';
            });

            $table->addColumn('qr_code_qr_code_value', function ($row) {
                return $row->qr_code ? $row->qr_code->qr_code_value : '';
            });

            $table->editColumn('member_role', function ($row) {
                return "test";
            });
            $table->editColumn('extra_field', function ($row) {
                return $row->extra_field ? $row->extra_field : '';
            });
            $table->addColumn('transportation_title', function ($row) {
                return $row->transportation ? $row->transportation->title : '';
            });

            $table->editColumn('team', function ($row) {
                return $row->teams->first()->team_name ?? '';
            });


            $table->rawColumns(['actions', 'placeholder', 'is_new', 'major', 'study_level', 'tshirt_size', 'qr_code', 'transportation']);

            return $table->make(true);
        }

        $majors          = Major::get();
        $study_levelsses = StudyLevelss::get();
        $tshirt_sizes    = TshirtSize::get();
        $qr_codes        = QrCode::get();
        $transportations = Transportation::get();
        $users           = User::get();

        return view('admin.members.index', compact('majors', 'study_levelsses', 'tshirt_sizes', 'qr_codes', 'transportations', 'users'));
    }

    public function getMedia(Request $request)
    {
        abort_if(Gate::denies('member_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Member::select(sprintf('%s.*', (new Member)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('uuid', function ($row) {
                return $row->uuid ? $row->uuid : '';
            });
            $table->editColumn('national', function ($row) {
                return $row->national ? $row->national : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->editColumn('extra_field', function ($row) {
                return $row->extra_field ? $row->extra_field : '';
            });

            $table->rawColumns([ 'placeholder']);

            return $table->make(true);
        }

        $users           = User::get();

        return view('admin.members.media', compact('users'));
    }

    public function showOnsiteMembers(Request $request){
        abort_if(Gate::denies('member_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $status = 'accepted_onsite';
            $query = Member::with(['major', 'study_level', 'tshirt_size', 'qr_code', 'transportation', 'created_by'])->select(sprintf('%s.*', (new Member)->table))->whereHas('teams', function ($query) use ($status) {
                $query->where('status', $status);
            });
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'member_show';
                $editGate      = 'member_edit';
                $deleteGate    = 'member_delete';
                $crudRoutePart = 'members';

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
            $table->editColumn('national', function ($row) {
                return $row->national ? $row->national : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->editColumn('age', function ($row) {
                return $row->age ? $row->age : '';
            });

            $table->editColumn('is_new', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_new ? 'checked' : null) . '>';
            });
            $table->addColumn('major_title', function ($row) {
                return $row->major ? $row->major->title : '';
            });

            $table->editColumn('organization', function ($row) {
                return $row->organization ? $row->organization : '';
            });
            $table->editColumn('participant_type', function ($row) {
                return $row->participant_type ? Member::PARTICIPANT_TYPE_SELECT[$row->participant_type] : '';
            });
            $table->addColumn('study_level_title', function ($row) {
                return $row->study_level ? $row->study_level->title : '';
            });

            $table->addColumn('tshirt_size_title', function ($row) {
                return $row->tshirt_size ? $row->tshirt_size->title : '';
            });

            $table->addColumn('qr_code_qr_code_value', function ($row) {
                return $row->qr_code ? $row->qr_code->qr_code_value : '';
            });

            $table->editColumn('member_role', function ($row) {
                return "test";
            });
            $table->editColumn('extra_field', function ($row) {
                return $row->extra_field ? $row->extra_field : '';
            });
            $table->addColumn('transportation_title', function ($row) {
                return $row->transportation ? $row->transportation->title : '';
            });

            $table->editColumn('team', function ($row) {
                return $row->teams->first()->team_name ?? '';
            });


            $table->rawColumns(['actions', 'placeholder', 'is_new', 'major', 'study_level', 'tshirt_size', 'qr_code', 'transportation']);

            return $table->make(true);
        }

        $majors          = Major::get();
        $study_levelsses = StudyLevelss::get();
        $tshirt_sizes    = TshirtSize::get();
        $qr_codes        = QrCode::get();
        $transportations = Transportation::get();
        $users           = User::get();

        return view('admin.members.extra.showOnsiteMembers', compact('majors', 'study_levelsses', 'tshirt_sizes', 'qr_codes', 'transportations', 'users'));
    }
    public function showNonOnsiteMembers(Request $request){
        abort_if(Gate::denies('member_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $status = 'accepted_onsite';
            $query = Member::with(['major', 'study_level', 'tshirt_size', 'qr_code', 'transportation', 'created_by'])->select(sprintf('%s.*', (new Member)->table))->whereHas('teams', function ($query) use ($status) {
                $query->where('status','!=', $status);
            });
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'member_show';
                $editGate      = 'member_edit';
                $deleteGate    = 'member_delete';
                $crudRoutePart = 'members';

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
            $table->editColumn('national', function ($row) {
                return $row->national ? $row->national : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->editColumn('age', function ($row) {
                return $row->age ? $row->age : '';
            });

            $table->editColumn('is_new', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_new ? 'checked' : null) . '>';
            });
            $table->addColumn('major_title', function ($row) {
                return $row->major ? $row->major->title : '';
            });

            $table->editColumn('organization', function ($row) {
                return $row->organization ? $row->organization : '';
            });
            $table->editColumn('participant_type', function ($row) {
                return $row->participant_type ? Member::PARTICIPANT_TYPE_SELECT[$row->participant_type] : '';
            });
            $table->addColumn('study_level_title', function ($row) {
                return $row->study_level ? $row->study_level->title : '';
            });

            $table->addColumn('tshirt_size_title', function ($row) {
                return $row->tshirt_size ? $row->tshirt_size->title : '';
            });

            $table->addColumn('qr_code_qr_code_value', function ($row) {
                return $row->qr_code ? $row->qr_code->qr_code_value : '';
            });

            $table->editColumn('member_role', function ($row) {
                return "test";
            });
            $table->editColumn('extra_field', function ($row) {
                return $row->extra_field ? $row->extra_field : '';
            });
            $table->addColumn('transportation_title', function ($row) {
                return $row->transportation ? $row->transportation->title : '';
            });

            $table->editColumn('team', function ($row) {
                return $row->teams->first()->team_name ?? '';
            });


            $table->rawColumns(['actions', 'placeholder', 'is_new', 'major', 'study_level', 'tshirt_size', 'qr_code', 'transportation']);

            return $table->make(true);
        }

        $majors          = Major::get();
        $study_levelsses = StudyLevelss::get();
        $tshirt_sizes    = TshirtSize::get();
        $qr_codes        = QrCode::get();
        $transportations = Transportation::get();
        $users           = User::get();

        return view('admin.members.extra.showNonOnsiteMembers', compact('majors', 'study_levelsses', 'tshirt_sizes', 'qr_codes', 'transportations', 'users'));
    }
    public function showVirtualMembers(Request $request){
        abort_if(Gate::denies('member_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $status = 'accepted_virtual';
            $query = Member::with(['major', 'study_level', 'tshirt_size', 'qr_code', 'transportation', 'created_by'])->select(sprintf('%s.*', (new Member)->table))->whereHas('teams', function ($query) use ($status) {
                $query->where('status', $status);
            });
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'member_show';
                $editGate      = 'member_edit';
                $deleteGate    = 'member_delete';
                $crudRoutePart = 'members';

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
            $table->editColumn('national', function ($row) {
                return $row->national ? $row->national : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->editColumn('age', function ($row) {
                return $row->age ? $row->age : '';
            });

            $table->editColumn('is_new', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_new ? 'checked' : null) . '>';
            });
            $table->addColumn('major_title', function ($row) {
                return $row->major ? $row->major->title : '';
            });

            $table->editColumn('organization', function ($row) {
                return $row->organization ? $row->organization : '';
            });
            $table->editColumn('participant_type', function ($row) {
                return $row->participant_type ? Member::PARTICIPANT_TYPE_SELECT[$row->participant_type] : '';
            });
            $table->addColumn('study_level_title', function ($row) {
                return $row->study_level ? $row->study_level->title : '';
            });

            $table->addColumn('tshirt_size_title', function ($row) {
                return $row->tshirt_size ? $row->tshirt_size->title : '';
            });

            $table->addColumn('qr_code_qr_code_value', function ($row) {
                return $row->qr_code ? $row->qr_code->qr_code_value : '';
            });

            $table->editColumn('member_role', function ($row) {
                return "test";
            });
            $table->editColumn('extra_field', function ($row) {
                return $row->extra_field ? $row->extra_field : '';
            });
            $table->addColumn('transportation_title', function ($row) {
                return $row->transportation ? $row->transportation->title : '';
            });

            $table->editColumn('team', function ($row) {
                return $row->teams->first()->team_name ?? '';
            });


            $table->rawColumns(['actions', 'placeholder', 'is_new', 'major', 'study_level', 'tshirt_size', 'qr_code', 'transportation']);

            return $table->make(true);
        }

        $majors          = Major::get();
        $study_levelsses = StudyLevelss::get();
        $tshirt_sizes    = TshirtSize::get();
        $qr_codes        = QrCode::get();
        $transportations = Transportation::get();
        $users           = User::get();

        return view('admin.members.extra.showVirtualMembers', compact('majors', 'study_levelsses', 'tshirt_sizes', 'qr_codes', 'transportations', 'users'));
    }
    public function showRejectedMembers(Request $request){
        abort_if(Gate::denies('member_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $status = 'rejected';
            $query = Member::with(['major', 'study_level', 'tshirt_size', 'qr_code', 'transportation', 'created_by'])->select(sprintf('%s.*', (new Member)->table))->whereHas('teams', function ($query) use ($status) {
                $query->where('status', $status);
            });
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'member_show';
                $editGate      = 'member_edit';
                $deleteGate    = 'member_delete';
                $crudRoutePart = 'members';

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
            $table->editColumn('national', function ($row) {
                return $row->national ? $row->national : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->editColumn('age', function ($row) {
                return $row->age ? $row->age : '';
            });

            $table->editColumn('is_new', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_new ? 'checked' : null) . '>';
            });
            $table->addColumn('major_title', function ($row) {
                return $row->major ? $row->major->title : '';
            });

            $table->editColumn('organization', function ($row) {
                return $row->organization ? $row->organization : '';
            });
            $table->editColumn('participant_type', function ($row) {
                return $row->participant_type ? Member::PARTICIPANT_TYPE_SELECT[$row->participant_type] : '';
            });
            $table->addColumn('study_level_title', function ($row) {
                return $row->study_level ? $row->study_level->title : '';
            });

            $table->addColumn('tshirt_size_title', function ($row) {
                return $row->tshirt_size ? $row->tshirt_size->title : '';
            });

            $table->addColumn('qr_code_qr_code_value', function ($row) {
                return $row->qr_code ? $row->qr_code->qr_code_value : '';
            });

            $table->editColumn('member_role', function ($row) {
                return "test";
            });
            $table->editColumn('extra_field', function ($row) {
                return $row->extra_field ? $row->extra_field : '';
            });
            $table->addColumn('transportation_title', function ($row) {
                return $row->transportation ? $row->transportation->title : '';
            });

            $table->editColumn('team', function ($row) {
                return $row->teams->first()->team_name ?? '';
            });


            $table->rawColumns(['actions', 'placeholder', 'is_new', 'major', 'study_level', 'tshirt_size', 'qr_code', 'transportation']);

            return $table->make(true);
        }

        $majors          = Major::get();
        $study_levelsses = StudyLevelss::get();
        $tshirt_sizes    = TshirtSize::get();
        $qr_codes        = QrCode::get();
        $transportations = Transportation::get();
        $users           = User::get();

        return view('admin.members.extra.showRejectedMembers', compact('majors', 'study_levelsses', 'tshirt_sizes', 'qr_codes', 'transportations', 'users'));
    }
    public function showNullMembers(Request $request){
        abort_if(Gate::denies('member_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $status = null;
            $query = Member::with(['major', 'study_level', 'tshirt_size', 'qr_code', 'transportation', 'created_by'])->select(sprintf('%s.*', (new Member)->table))->whereHas('teams', function ($query) use ($status) {
                $query->where('status', $status);
            });
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'member_show';
                $editGate      = 'member_edit';
                $deleteGate    = 'member_delete';
                $crudRoutePart = 'members';

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
            $table->editColumn('national', function ($row) {
                return $row->national ? $row->national : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->editColumn('age', function ($row) {
                return $row->age ? $row->age : '';
            });

            $table->editColumn('is_new', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_new ? 'checked' : null) . '>';
            });
            $table->addColumn('major_title', function ($row) {
                return $row->major ? $row->major->title : '';
            });

            $table->editColumn('organization', function ($row) {
                return $row->organization ? $row->organization : '';
            });
            $table->editColumn('participant_type', function ($row) {
                return $row->participant_type ? Member::PARTICIPANT_TYPE_SELECT[$row->participant_type] : '';
            });
            $table->addColumn('study_level_title', function ($row) {
                return $row->study_level ? $row->study_level->title : '';
            });

            $table->addColumn('tshirt_size_title', function ($row) {
                return $row->tshirt_size ? $row->tshirt_size->title : '';
            });

            $table->addColumn('qr_code_qr_code_value', function ($row) {
                return $row->qr_code ? $row->qr_code->qr_code_value : '';
            });

            $table->editColumn('member_role', function ($row) {
                return "test";
            });
            $table->editColumn('extra_field', function ($row) {
                return $row->extra_field ? $row->extra_field : '';
            });
            $table->addColumn('transportation_title', function ($row) {
                return $row->transportation ? $row->transportation->title : '';
            });

            $table->editColumn('team', function ($row) {
                return $row->teams->first()->team_name ?? '';
            });


            $table->rawColumns(['actions', 'placeholder', 'is_new', 'major', 'study_level', 'tshirt_size', 'qr_code', 'transportation']);

            return $table->make(true);
        }

        $majors          = Major::get();
        $study_levelsses = StudyLevelss::get();
        $tshirt_sizes    = TshirtSize::get();
        $qr_codes        = QrCode::get();
        $transportations = Transportation::get();
        $users           = User::get();

        return view('admin.members.extra.showNullMembers', compact('majors', 'study_levelsses', 'tshirt_sizes', 'qr_codes', 'transportations', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('member_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $majors = Major::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $study_levels = StudyLevelss::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tshirt_sizes = TshirtSize::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $qr_codes = QrCode::pluck('qr_code_value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transportations = Transportation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.members.create', compact('majors', 'qr_codes', 'study_levels', 'transportations', 'tshirt_sizes'));
    }

    public function store(StoreMemberRequest $request)
    {
        $member = Member::create($request->all());

        if ($request->input('nationa_id_photo', false)) {
            $member->addMedia(storage_path('tmp/uploads/' . basename($request->input('nationa_id_photo'))))->toMediaCollection('nationa_id_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $member->id]);
        }

        return redirect()->route('admin.members.index');
    }

    public function edit(Member $member)
    {
        abort_if(Gate::denies('member_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $majors = Major::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $study_levels = StudyLevelss::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tshirt_sizes = TshirtSize::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $qr_codes = QrCode::pluck('qr_code_value', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transportations = Transportation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $member->load('major', 'study_level', 'tshirt_size', 'qr_code', 'transportation', 'created_by');

        return view('admin.members.edit', compact('majors', 'member', 'qr_codes', 'study_levels', 'transportations', 'tshirt_sizes'));
    }

    public function update(UpdateMemberRequest $request, Member $member)
    {
        $member->update($request->all());

        if ($request->input('nationa_id_photo', false)) {
            if (! $member->nationa_id_photo || $request->input('nationa_id_photo') !== $member->nationa_id_photo->file_name) {
                if ($member->nationa_id_photo) {
                    $member->nationa_id_photo->delete();
                }
                $member->addMedia(storage_path('tmp/uploads/' . basename($request->input('nationa_id_photo'))))->toMediaCollection('nationa_id_photo');
            }
        } elseif ($member->nationa_id_photo) {
            $member->nationa_id_photo->delete();
        }

        return redirect()->route('admin.members.index');
    }

    public function show(Member $member)
    {
        abort_if(Gate::denies('member_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $member->load('major', 'study_level', 'tshirt_size', 'qr_code', 'transportation', 'created_by', 'teamLeaderTeams', 'memberMemberCheckpoints');

        return view('admin.members.show', compact('member'));
    }

    public function destroy(Member $member)
    {
        abort_if(Gate::denies('member_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $member->delete();

        return back();
    }

    public function massDestroy(MassDestroyMemberRequest $request)
    {
        $members = Member::find(request('ids'));

        foreach ($members as $member) {
            $member->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('member_create') && Gate::denies('member_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Member();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
