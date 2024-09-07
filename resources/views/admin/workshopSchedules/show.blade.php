@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.workshopSchedule.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.workshop-schedules.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.workshopSchedule.fields.id') }}
                        </th>
                        <td>
                            {{ $workshopSchedule->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workshopSchedule.fields.workshop') }}
                        </th>
                        <td>
                            {{ $workshopSchedule->workshop->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workshopSchedule.fields.schedule_time') }}
                        </th>
                        <td>
                            {{ $workshopSchedule->schedule_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workshopSchedule.fields.capacity') }}
                        </th>
                        <td>
                            {{ $workshopSchedule->capacity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Available
                        </th>
                        <td>
                            {{ $workshopSchedule->SchedualWorkshopAvailability }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.workshop-schedules.index') }}">
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
            <a class="nav-link" href="#workshop_schedule_participant_workshop_assignments" role="tab" data-toggle="tab">
                {{ trans('cruds.participantWorkshopAssignment.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="workshop_schedule_participant_workshop_assignments">
            @includeIf('admin.workshopSchedules.relationships.workshopScheduleParticipantWorkshopAssignments', ['participantWorkshopAssignments' => $workshopSchedule->workshopScheduleParticipantWorkshopAssignments])
        </div>
    </div>
</div>

@endsection
