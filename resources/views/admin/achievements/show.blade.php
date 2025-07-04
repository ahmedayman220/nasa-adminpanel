@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.achievement.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.achievements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.achievement.fields.id') }}
                        </th>
                        <td>
                            {{ $achievement->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.achievement.fields.name') }}
                        </th>
                        <td>
                            {{ $achievement->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.achievement.fields.description') }}
                        </th>
                        <td>
                            {{ $achievement->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.achievements.index') }}">
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
            <a class="nav-link" href="#achievement_team_achievements" role="tab" data-toggle="tab">
                {{ trans('cruds.teamAchievement.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="achievement_team_achievements">
            @includeIf('admin.achievements.relationships.achievementTeamAchievements', ['teamAchievements' => $achievement->achievementTeamAchievements])
        </div>
    </div>
</div>

@endsection