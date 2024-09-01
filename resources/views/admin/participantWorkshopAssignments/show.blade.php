@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.participantWorkshopAssignment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.participant-workshop-assignments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.participantWorkshopAssignment.fields.id') }}
                        </th>
                        <td>
                            {{ $participantWorkshopAssignment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.participantWorkshopAssignment.fields.bootcamp_participant') }}
                        </th>
                        <td>
                            {{ $participantWorkshopAssignment->bootcamp_participant->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.participantWorkshopAssignment.fields.workshop_schedule') }}
                        </th>
                        <td>
                            {{ $participantWorkshopAssignment->workshop_schedule->schedule_time ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.participantWorkshopAssignment.fields.attendance_status') }}
                        </th>
                        <td>
                            {{ App\Models\ParticipantWorkshopAssignment::ATTENDANCE_STATUS_SELECT[$participantWorkshopAssignment->attendance_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.participantWorkshopAssignment.fields.check_in_time') }}
                        </th>
                        <td>
                            {{ $participantWorkshopAssignment->check_in_time }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.participant-workshop-assignments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection