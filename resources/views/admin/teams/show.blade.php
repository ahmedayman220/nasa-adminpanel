@extends('layouts.admin')
@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{session()->get('success')}}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.team.title') }}
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.teams.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.id') }}
                        </th>
                        <td>
                            {{ $team->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.uuid') }}
                        </th>
                        <td>
                            {{ $team->uuid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.team_leader') }}
                        </th>
                        <td>
                            {{ $team->team_leader->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.team_name') }}
                        </th>
                        <td>
                            {{ $team->team_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.challenge') }}
                        </th>
                        <td>
                            {{ $team->challenge->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.actual_solution') }}
                        </th>
                        <td>
                            {{ $team->actual_solution->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.mentorship_needed') }}
                        </th>
                        <td>
                            {{ $team->mentorship_needed->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.participation_method') }}
                        </th>
                        <td>
                            {{ $team->participation_method->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.team_photo') }}
                        </th>
                        <td>
                            @if($team->team_photo)
                                <a href="{{ $team->team_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $team->team_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.limited_capacity') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $team->limited_capacity ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.members_participated_before') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $team->members_participated_before ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.project_proposal_url') }}
                        </th>
                        <td>
                            {{ $team->project_proposal_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.project_video_url') }}
                        </th>
                        <td>
                            {{ $team->project_video_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ "Relevancy" }}
                        </th>
                        <td>
                            {{ $team->relevancy }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ "Impact" }}
                        </th>
                        <td>
                            {{ $team->impact }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ "Creativity/Innovation" }}
                        </th>
                        <td>
                            {{ $team->creativity }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ "Proposal" }}
                        </th>
                        <td>
                            {{ $team->proposal }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ "Video" }}
                        </th>
                        <td>
                            {{ $team->video }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.total_score') }}
                        </th>
                        <td>
                            {{ $team->total_score }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Team::STATUS_SELECT[$team->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.submission_date') }}
                        </th>
                        <td>
                            {{ $team->submission_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.nots') }}
                        </th>
                        <td>
                            {!! $team->nots !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.extra_field') }}
                        </th>
                        <td>
                            {{ $team->extra_field }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.team.fields.description') }}
                        </th>
                        <td>
                            {!! $team->description !!}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.teams.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
{{-- Score Changes --}}
    <div class="card">
        <div class="card-header">
            Edit Team Score
        </div>
        <div class="card-body">
            <form action="{{route('admin.teams.updateTeamScore',$team->id)}}" method="post">
                @csrf
                <div class="form-group">
                <label>Relevancy</label>
                <input type="number" min="0" max="5" class="form-control" name="relevancy" value="{{$team->relevancy}}">
                </div>

                <div class="form-group">
                <label>Impact</label>
                <input type="number" min="0" max="5" class="form-control" name="impact" value="{{$team->impact}}">
                </div>

                <div class="form-group">
                <label>Creativity/Innovation</label>
                <input type="number" min="0" max="5" class="form-control" name="creativity" value="{{$team->creativity}}">
                </div>

                <div class="form-group">
                <label>Proposal</label>
                <input type="number" min="0" max="5" class="form-control" name="proposal" value="{{$team->proposal}}">
                </div>

                <div class="form-group">
                <label>Video</label>
                <input type="number" min="0" max="5" class="form-control" name="video" value="{{$team->video}}">
                </div>

                <input type="Submit" value="Submit Changes" class="btn btn-primary">

            </form>
        </div>
    </div>
@endsection
