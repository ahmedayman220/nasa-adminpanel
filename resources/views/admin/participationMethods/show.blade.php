@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.participationMethod.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.participation-methods.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.participationMethod.fields.id') }}
                        </th>
                        <td>
                            {{ $participationMethod->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.participationMethod.fields.title') }}
                        </th>
                        <td>
                            {{ $participationMethod->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.participationMethod.fields.extra_field') }}
                        </th>
                        <td>
                            {{ $participationMethod->extra_field }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.participationMethod.fields.description') }}
                        </th>
                        <td>
                            {!! $participationMethod->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.participation-methods.index') }}">
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
            <a class="nav-link" href="#participation_method_teams" role="tab" data-toggle="tab">
                {{ trans('cruds.team.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="participation_method_teams">
            @includeIf('admin.participationMethods.relationships.participationMethodTeams', ['teams' => $participationMethod->participationMethodTeams])
        </div>
    </div>
</div>

@endsection