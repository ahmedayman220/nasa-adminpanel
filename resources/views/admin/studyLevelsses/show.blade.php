@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.studyLevelss.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.study-levelsses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.studyLevelss.fields.id') }}
                        </th>
                        <td>
                            {{ $studyLevelss->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studyLevelss.fields.title') }}
                        </th>
                        <td>
                            {{ $studyLevelss->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studyLevelss.fields.extra_field') }}
                        </th>
                        <td>
                            {{ $studyLevelss->extra_field }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studyLevelss.fields.description') }}
                        </th>
                        <td>
                            {!! $studyLevelss->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.study-levelsses.index') }}">
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
            <a class="nav-link" href="#study_level_members" role="tab" data-toggle="tab">
                {{ trans('cruds.member.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="study_level_members">
            @includeIf('admin.studyLevelsses.relationships.studyLevelMembers', ['members' => $studyLevelss->studyLevelMembers])
        </div>
    </div>
</div>

@endsection