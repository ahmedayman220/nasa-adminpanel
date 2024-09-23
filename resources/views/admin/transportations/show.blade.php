@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.transportation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transportations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.transportation.fields.id') }}
                        </th>
                        <td>
                            {{ $transportation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transportation.fields.title') }}
                        </th>
                        <td>
                            {{ $transportation->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transportation.fields.extra_field') }}
                        </th>
                        <td>
                            {{ $transportation->extra_field }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transportation.fields.description') }}
                        </th>
                        <td>
                            {!! $transportation->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transportations.index') }}">
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
            <a class="nav-link" href="#transportation_members" role="tab" data-toggle="tab">
                {{ trans('cruds.member.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="transportation_members">
            @includeIf('admin.transportations.relationships.transportationMembers', ['members' => $transportation->transportationMembers])
        </div>
    </div>
</div>

@endsection