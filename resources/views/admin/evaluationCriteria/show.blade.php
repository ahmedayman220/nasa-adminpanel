@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.evaluationCriterion.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.evaluation-criteria.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.evaluationCriterion.fields.id') }}
                        </th>
                        <td>
                            {{ $evaluationCriterion->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.evaluationCriterion.fields.name') }}
                        </th>
                        <td>
                            {{ $evaluationCriterion->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.evaluationCriterion.fields.weight') }}
                        </th>
                        <td>
                            {{ $evaluationCriterion->weight }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.evaluation-criteria.index') }}">
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
            <a class="nav-link" href="#criteria_evaluations" role="tab" data-toggle="tab">
                {{ trans('cruds.evaluation.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="criteria_evaluations">
            @includeIf('admin.evaluationCriteria.relationships.criteriaEvaluations', ['evaluations' => $evaluationCriterion->criteriaEvaluations])
        </div>
    </div>
</div>

@endsection