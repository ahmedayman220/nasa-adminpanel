@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.actualSolution.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.actual-solutions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.actualSolution.fields.id') }}
                        </th>
                        <td>
                            {{ $actualSolution->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.actualSolution.fields.title') }}
                        </th>
                        <td>
                            {{ $actualSolution->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.actualSolution.fields.extra_field') }}
                        </th>
                        <td>
                            {{ $actualSolution->extra_field }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.actualSolution.fields.description') }}
                        </th>
                        <td>
                            {{ $actualSolution->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.actual-solutions.index') }}">
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
            <a class="nav-link" href="#actual_solution_teams" role="tab" data-toggle="tab">
                {{ trans('cruds.team.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="actual_solution_teams">
            @includeIf('admin.actualSolutions.relationships.actualSolutionTeams', ['teams' => $actualSolution->actualSolutionTeams])
        </div>
    </div>
</div>

@endsection