@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.checkpointType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.checkpoint-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpointType.fields.id') }}
                        </th>
                        <td>
                            {{ $checkpointType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.checkpointType.fields.name') }}
                        </th>
                        <td>
                            {{ $checkpointType->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.checkpoint-types.index') }}">
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
            <a class="nav-link" href="#checkpoint_type_checkpoints" role="tab" data-toggle="tab">
                {{ trans('cruds.checkpoint.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="checkpoint_type_checkpoints">
            @includeIf('admin.checkpointTypes.relationships.checkpointTypeCheckpoints', ['checkpoints' => $checkpointType->checkpointTypeCheckpoints])
        </div>
    </div>
</div>

@endsection