@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.judge.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.judges.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.judge.fields.id') }}
                        </th>
                        <td>
                            {{ $judge->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.judge.fields.name') }}
                        </th>
                        <td>
                            {{ $judge->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.judge.fields.expertise') }}
                        </th>
                        <td>
                            {{ $judge->expertise }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.judges.index') }}">
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
            <a class="nav-link" href="#judge_evaluations" role="tab" data-toggle="tab">
                {{ trans('cruds.evaluation.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="judge_evaluations">
            @includeIf('admin.judges.relationships.judgeEvaluations', ['evaluations' => $judge->judgeEvaluations])
        </div>
    </div>
</div>

@endsection