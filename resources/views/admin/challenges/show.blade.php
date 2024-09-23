@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.challenge.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.challenges.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.id') }}
                        </th>
                        <td>
                            {{ $challenge->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.title') }}
                        </th>
                        <td>
                            {{ $challenge->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.category') }}
                        </th>
                        <td>
                            {{ $challenge->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.extra_field') }}
                        </th>
                        <td>
                            {{ $challenge->extra_field }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.description') }}
                        </th>
                        <td>
                            {!! $challenge->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.challenge.fields.difficulty_level') }}
                        </th>
                        <td>
                            {{ $challenge->difficulty_level->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.challenges.index') }}">
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
            <a class="nav-link" href="#challenge_teams" role="tab" data-toggle="tab">
                {{ trans('cruds.team.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="challenge_teams">
            @includeIf('admin.challenges.relationships.challengeTeams', ['teams' => $challenge->challengeTeams])
        </div>
    </div>
</div>

@endsection