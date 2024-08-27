@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mentionYourField.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mention-your-fields.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.mentionYourField.fields.id') }}
                        </th>
                        <td>
                            {{ $mentionYourField->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mentionYourField.fields.title') }}
                        </th>
                        <td>
                            {{ $mentionYourField->title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mention-your-fields.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#field_of_study_bootcamp_participants" role="tab" data-toggle="tab">
                {{ trans('cruds.bootcampParticipant.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="field_of_study_bootcamp_participants">
            @includeIf('admin.mentionYourFields.relationships.fieldOfStudyBootcampParticipants', ['bootcampParticipants' => $mentionYourField->fieldOfStudyBootcampParticipants])
        </div>
    </div>
</div>

@endsection