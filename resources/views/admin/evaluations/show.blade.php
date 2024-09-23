@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.evaluation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.evaluations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.evaluation.fields.id') }}
                        </th>
                        <td>
                            {{ $evaluation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.evaluation.fields.judge') }}
                        </th>
                        <td>
                            {{ $evaluation->judge->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.evaluation.fields.score') }}
                        </th>
                        <td>
                            {{ $evaluation->score }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.evaluation.fields.criteria') }}
                        </th>
                        <td>
                            {{ $evaluation->criteria->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.evaluations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection