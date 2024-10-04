<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMemberCheckpointRequest;
use App\Http\Requests\StoreMemberCheckpointRequest;
use App\Http\Requests\UpdateMemberCheckpointRequest;
use App\Models\Checkpoint;
use App\Models\Member;
use App\Models\MemberCheckpoint;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MemberCheckpointsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('member_checkpoint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MemberCheckpoint::with(['member', 'checkpoint', 'created_by'])->select(sprintf('%s.*', (new MemberCheckpoint)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'member_checkpoint_show';
                $editGate      = 'member_checkpoint_edit';
                $deleteGate    = 'member_checkpoint_delete';
                $crudRoutePart = 'member-checkpoints';

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
            $table->addColumn('member_name', function ($row) {
                return $row->member ? $row->member->name : '';
            });
            $table->addColumn('member_uuid', function ($row) {
                return $row->member ? $row->member->uuid : '';
            });

            $table->addColumn('checkpoint_name', function ($row) {
                return $row->checkpoint ? $row->checkpoint->name : '';
            });

            $table->editColumn('completed', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->completed ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'member', 'checkpoint', 'completed']);

            return $table->make(true);
        }

        $members     = Member::get();
        $checkpoints = Checkpoint::get();
        $users       = User::get();

        return view('admin.memberCheckpoints.index', compact('members', 'checkpoints', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('member_checkpoint_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $members = Member::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $checkpoints = Checkpoint::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.memberCheckpoints.create', compact('checkpoints', 'members'));
    }

    public function store(StoreMemberCheckpointRequest $request)
    {
        $memberCheckpoint = MemberCheckpoint::create($request->all());

        return redirect()->route('admin.member-checkpoints.index');
    }

    public function edit(MemberCheckpoint $memberCheckpoint)
    {
        abort_if(Gate::denies('member_checkpoint_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $members = Member::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $checkpoints = Checkpoint::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $memberCheckpoint->load('member', 'checkpoint', 'created_by');

        return view('admin.memberCheckpoints.edit', compact('checkpoints', 'memberCheckpoint', 'members'));
    }

    public function update(UpdateMemberCheckpointRequest $request, MemberCheckpoint $memberCheckpoint)
    {
        $memberCheckpoint->update($request->all());

        return redirect()->route('admin.member-checkpoints.index');
    }

    public function show(MemberCheckpoint $memberCheckpoint)
    {
        abort_if(Gate::denies('member_checkpoint_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $memberCheckpoint->load('member', 'checkpoint', 'created_by');

        return view('admin.memberCheckpoints.show', compact('memberCheckpoint'));
    }

    public function destroy(MemberCheckpoint $memberCheckpoint)
    {
        abort_if(Gate::denies('member_checkpoint_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $memberCheckpoint->delete();

        return back();
    }

    public function massDestroy(MassDestroyMemberCheckpointRequest $request)
    {
        $memberCheckpoints = MemberCheckpoint::find(request('ids'));

        foreach ($memberCheckpoints as $memberCheckpoint) {
            $memberCheckpoint->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
