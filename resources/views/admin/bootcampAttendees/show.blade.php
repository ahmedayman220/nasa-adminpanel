@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bootcampAttendee.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bootcamp-attendees.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampAttendee.fields.id') }}
                        </th>
                        <td>
                            {{ $bootcampAttendee->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampAttendee.fields.bootcamp_details') }}
                        </th>
                        <td>
                            {{ $bootcampAttendee->bootcamp_details->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampAttendee.fields.bootcamp_participant') }}
                        </th>
                        <td>
                            {{ $bootcampAttendee->bootcamp_participant->name_en ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampAttendee.fields.category') }}
                        </th>
                        <td>
                            {{ App\Models\BootcampAttendee::CATEGORY_RADIO[$bootcampAttendee->category] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampAttendee.fields.attendance_status') }}
                        </th>
                        <td>
                            {{ App\Models\BootcampAttendee::ATTENDANCE_STATUS_RADIO[$bootcampAttendee->attendance_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampAttendee.fields.check_in_time') }}
                        </th>
                        <td>
                            {{ $bootcampAttendee->check_in_time }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bootcamp-attendees.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
