@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.workshop.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.workshops.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.workshop.fields.id') }}
                        </th>
                        <td>
                            {{ $workshop->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workshop.fields.title') }}
                        </th>
                        <td>
                            {{ $workshop->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workshop.fields.descriptions') }}
                        </th>
                        <td>
                            {!! $workshop->descriptions !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.workshops.index') }}">
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
            <a class="nav-link" href="#workshop_workshop_schedules" role="tab" data-toggle="tab">
                {{ trans('cruds.workshopSchedule.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#workshop_participant_workshop_preferences" role="tab" data-toggle="tab">
                {{ trans('cruds.participantWorkshopPreference.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#first_priority_bootcamp_participants" role="tab" data-toggle="tab">
                {{ trans('cruds.bootcampParticipant.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#second_priority_bootcamp_participants" role="tab" data-toggle="tab">
                {{ trans('cruds.bootcampParticipant.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#third_priority_bootcamp_participants" role="tab" data-toggle="tab">
                {{ trans('cruds.bootcampParticipant.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="workshop_workshop_schedules">
            @includeIf('admin.workshops.relationships.workshopWorkshopSchedules', ['workshopSchedules' => $workshop->workshopWorkshopSchedules])
        </div>
        <div class="tab-pane" role="tabpanel" id="workshop_participant_workshop_preferences">
            @includeIf('admin.workshops.relationships.workshopParticipantWorkshopPreferences', ['participantWorkshopPreferences' => $workshop->workshopParticipantWorkshopPreferences])
        </div>
        <div class="tab-pane" role="tabpanel" id="first_priority_bootcamp_participants">
            @includeIf('admin.workshops.relationships.firstPriorityBootcampParticipants', ['bootcampParticipants' => $workshop->firstPriorityBootcampParticipants])
        </div>
        <div class="tab-pane" role="tabpanel" id="second_priority_bootcamp_participants">
            @includeIf('admin.workshops.relationships.secondPriorityBootcampParticipants', ['bootcampParticipants' => $workshop->secondPriorityBootcampParticipants])
        </div>
        <div class="tab-pane" role="tabpanel" id="third_priority_bootcamp_participants">
            @includeIf('admin.workshops.relationships.thirdPriorityBootcampParticipants', ['bootcampParticipants' => $workshop->thirdPriorityBootcampParticipants])
        </div>
    </div>
</div>

@endsection