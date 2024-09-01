<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMentionYourFieldRequest;
use App\Http\Requests\StoreMentionYourFieldRequest;
use App\Http\Requests\UpdateMentionYourFieldRequest;
use App\Models\MentionYourField;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MentionYourFieldController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('mention_your_field_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MentionYourField::with(['created_by'])->select(sprintf('%s.*', (new MentionYourField)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'mention_your_field_show';
                $editGate      = 'mention_your_field_edit';
                $deleteGate    = 'mention_your_field_delete';
                $crudRoutePart = 'mention-your-fields';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.mentionYourFields.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('mention_your_field_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mentionYourFields.create');
    }

    public function store(StoreMentionYourFieldRequest $request)
    {
        $mentionYourField = MentionYourField::create($request->all());

        return redirect()->route('admin.mention-your-fields.index');
    }

    public function edit(MentionYourField $mentionYourField)
    {
        abort_if(Gate::denies('mention_your_field_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mentionYourField->load('created_by');

        return view('admin.mentionYourFields.edit', compact('mentionYourField'));
    }

    public function update(UpdateMentionYourFieldRequest $request, MentionYourField $mentionYourField)
    {
        $mentionYourField->update($request->all());

        return redirect()->route('admin.mention-your-fields.index');
    }

    public function show(MentionYourField $mentionYourField)
    {
        abort_if(Gate::denies('mention_your_field_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mentionYourField->load('created_by', 'fieldOfStudyBootcampParticipants');

        return view('admin.mentionYourFields.show', compact('mentionYourField'));
    }

    public function destroy(MentionYourField $mentionYourField)
    {
        abort_if(Gate::denies('mention_your_field_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mentionYourField->delete();

        return back();
    }

    public function massDestroy(MassDestroyMentionYourFieldRequest $request)
    {
        $mentionYourFields = MentionYourField::find(request('ids'));

        foreach ($mentionYourFields as $mentionYourField) {
            $mentionYourField->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
