@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mentorshipNeeded.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mentorship-neededs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.mentorshipNeeded.fields.id') }}
                        </th>
                        <td>
                            {{ $mentorshipNeeded->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mentorshipNeeded.fields.title') }}
                        </th>
                        <td>
                            {{ $mentorshipNeeded->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mentorshipNeeded.fields.extra_field') }}
                        </th>
                        <td>
                            {{ $mentorshipNeeded->extra_field }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mentorshipNeeded.fields.description') }}
                        </th>
                        <td>
                            {!! $mentorshipNeeded->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mentorship-neededs.index') }}">
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
            <a class="nav-link" href="#mentorship_needed_teams" role="tab" data-toggle="tab">
                {{ trans('cruds.team.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#mentorship_needed_teams_onsite" role="tab" data-toggle="tab">
                Onsite Teams
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#mentorship_needed_teams_virtual" role="tab" data-toggle="tab">
                Virtual Teams
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="mentorship_needed_teams">
            @includeIf('admin.mentorshipNeededs.relationships.mentorshipNeededTeams', ['teams' => $mentorshipNeeded->mentorshipNeededTeams])
        </div>
        <div class="tab-pane" role="tabpanel" id="mentorship_needed_teams_onsite">
            @includeIf('admin.mentorshipNeededs.relationships.mentorshipNeededTeamsOnsite', ['teams' => $mentorshipNeeded->mentorshipNeededTeams])
        </div>
        <div class="tab-pane" role="tabpanel" id="mentorship_needed_teams_virtual">
            @includeIf('admin.mentorshipNeededs.relationships.mentorshipNeededTeamsVirtual', ['teams' => $mentorshipNeeded->mentorshipNeededTeams])
        </div>
    </div>
</div>

@endsection
