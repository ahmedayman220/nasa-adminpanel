@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.member.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.members.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.id') }}
                        </th>
                        <td>
                            {{ $member->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.uuid') }}
                        </th>
                        <td>
                            {{ $member->uuid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.national') }}
                        </th>
                        <td>
                            {{ $member->national }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.name') }}
                        </th>
                        <td>
                            {{ $member->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.email') }}
                        </th>
                        <td>
                            {{ $member->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $member->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.age') }}
                        </th>
                        <td>
                            {{ $member->age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.is_new') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $member->is_new ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.major') }}
                        </th>
                        <td>
                            {{ $member->major->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.organization') }}
                        </th>
                        <td>
                            {{ $member->organization }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.participant_type') }}
                        </th>
                        <td>
                            {{ App\Models\Member::PARTICIPANT_TYPE_SELECT[$member->participant_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.study_level') }}
                        </th>
                        <td>
                            {{ $member->study_level->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.tshirt_size') }}
                        </th>
                        <td>
                            {{ $member->tshirt_size->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.qr_code') }}
                        </th>
                        <td>
                            {{ $member->qr_code->qr_code_value ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.member_role') }}
                        </th>
                        <td>
                            {{ App\Models\Member::MEMBER_ROLE_SELECT[$member->member_role] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.extra_field') }}
                        </th>
                        <td>
                            {{ $member->extra_field }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.notes') }}
                        </th>
                        <td>
                            {!! $member->notes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.transportation') }}
                        </th>
                        <td>
                            {{ $member->transportation->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.members.index') }}">
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
            <a class="nav-link" href="#team_leader_teams" role="tab" data-toggle="tab">
                {{ trans('cruds.team.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#member_member_checkpoints" role="tab" data-toggle="tab">
                {{ trans('cruds.memberCheckpoint.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="team_leader_teams">
            @includeIf('admin.members.relationships.teamLeaderTeams', ['teams' => $member->teamLeaderTeams])
        </div>
        <div class="tab-pane" role="tabpanel" id="member_member_checkpoints">
            @includeIf('admin.members.relationships.memberMemberCheckpoints', ['memberCheckpoints' => $member->memberMemberCheckpoints])
        </div>
    </div>
</div>

@endsection