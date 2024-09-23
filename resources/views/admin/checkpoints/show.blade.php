@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.checkpoint.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.checkpoints.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.id') }}
                        </th>
                        <td>
                            {{ $checkpoint->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.event') }}
                        </th>
                        <td>
                            {{ $checkpoint->event->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.checkpoint_type') }}
                        </th>
                        <td>
                            {{ $checkpoint->checkpoint_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.name') }}
                        </th>
                        <td>
                            {{ $checkpoint->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpoint.fields.description') }}
                        </th>
                        <td>
                            {!! $checkpoint->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.checkpoints.index') }}">
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
            <a class="nav-link" href="#checkpoint_member_checkpoints" role="tab" data-toggle="tab">
                {{ trans('cruds.memberCheckpoint.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="checkpoint_member_checkpoints">
            @includeIf('admin.checkpoints.relationships.checkpointMemberCheckpoints', ['memberCheckpoints' => $checkpoint->checkpointMemberCheckpoints])
        </div>
    </div>
</div>

@endsection