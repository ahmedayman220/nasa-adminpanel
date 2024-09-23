<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMemberRoleRequest;
use App\Http\Requests\StoreMemberRoleRequest;
use App\Http\Requests\UpdateMemberRoleRequest;
use App\Models\MemberRole;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MemberRoleController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('member_role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MemberRole::with(['created_by'])->select(sprintf('%s.*', (new MemberRole)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'member_role_show';
                $editGate      = 'member_role_edit';
                $deleteGate    = 'member_role_delete';
                $crudRoutePart = 'member-roles';

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
            $table->editColumn('extra_field', function ($row) {
                return $row->extra_field ? $row->extra_field : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.memberRoles.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('member_role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.memberRoles.create');
    }

    public function store(StoreMemberRoleRequest $request)
    {
        $memberRole = MemberRole::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $memberRole->id]);
        }

        return redirect()->route('admin.member-roles.index');
    }

    public function edit(MemberRole $memberRole)
    {
        abort_if(Gate::denies('member_role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $memberRole->load('created_by');

        return view('admin.memberRoles.edit', compact('memberRole'));
    }

    public function update(UpdateMemberRoleRequest $request, MemberRole $memberRole)
    {
        $memberRole->update($request->all());

        return redirect()->route('admin.member-roles.index');
    }

    public function show(MemberRole $memberRole)
    {
        abort_if(Gate::denies('member_role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $memberRole->load('created_by');

        return view('admin.memberRoles.show', compact('memberRole'));
    }

    public function destroy(MemberRole $memberRole)
    {
        abort_if(Gate::denies('member_role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $memberRole->delete();

        return back();
    }

    public function massDestroy(MassDestroyMemberRoleRequest $request)
    {
        $memberRoles = MemberRole::find(request('ids'));

        foreach ($memberRoles as $memberRole) {
            $memberRole->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('member_role_create') && Gate::denies('member_role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MemberRole();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
