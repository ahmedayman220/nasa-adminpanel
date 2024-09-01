@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bootcampDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bootcamp-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $bootcampDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampDetail.fields.name') }}
                        </th>
                        <td>
                            {{ $bootcampDetail->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampDetail.fields.date') }}
                        </th>
                        <td>
                            {{ $bootcampDetail->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampDetail.fields.total_capacity') }}
                        </th>
                        <td>
                            {{ $bootcampDetail->total_capacity }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bootcamp-details.index') }}">
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
            <a class="nav-link" href="#bootcamp_details_bootcamp_attendees" role="tab" data-toggle="tab">
                {{ trans('cruds.bootcampAttendee.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="bootcamp_details_bootcamp_attendees">
            @includeIf('admin.bootcampDetails.relationships.bootcampDetailsBootcampAttendees', ['bootcampAttendees' => $bootcampDetail->bootcampDetailsBootcampAttendees])
        </div>
    </div>
</div>

@endsection