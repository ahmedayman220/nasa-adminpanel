@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bootcampParticipant.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bootcamp-participants.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.id') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.uuid') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->uuid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.name_en') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.email') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.age') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.educational_level') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->educational_level->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.field_of_study') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->field_of_study->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.educational_institute') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->educational_institute }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.graduation_year') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->graduation_year }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.position') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->position }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.national') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->national }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.national_id_front') }}
                        </th>
                        <td>
                            @if($bootcampParticipant->national_id_front)
                                <a href="{{ $bootcampParticipant->national_id_front->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $bootcampParticipant->national_id_front->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.national_id_back') }}
                        </th>
                        <td>
                            @if($bootcampParticipant->national_id_back)
                                <a href="{{ $bootcampParticipant->national_id_back->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $bootcampParticipant->national_id_back->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.is_participated') }}
                        </th>
                        <td>
                            {{ App\Models\BootcampParticipant::IS_PARTICIPATED_RADIO[$bootcampParticipant->is_participated] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.participated_year') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->participated_year }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.is_attend_formation_activity') }}
                        </th>
                        <td>
                            {{ App\Models\BootcampParticipant::IS_ATTEND_FORMATION_ACTIVITY_RADIO[$bootcampParticipant->is_attend_formation_activity] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.first_priority') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->first_priority->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.second_priority') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->second_priority->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.third_priority') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->third_priority->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.why_this_workshop') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->why_this_workshop }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.is_have_team') }}
                        </th>
                        <td>
                            {{ App\Models\BootcampParticipant::IS_HAVE_TEAM_RADIO[$bootcampParticipant->is_have_team] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.comment') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->comment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.year') }}
                        </th>
                        <td>
                            {{ $bootcampParticipant->year }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bootcamp-participants.index') }}">
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
            <a class="nav-link" href="#bootcamp_participant_participant_workshop_assignments" role="tab" data-toggle="tab">
                {{ trans('cruds.participantWorkshopAssignment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#bootcamp_participant_participant_workshop_preferences" role="tab" data-toggle="tab">
                {{ trans('cruds.participantWorkshopPreference.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#bootcamp_participant_bootcamp_attendees" role="tab" data-toggle="tab">
                {{ trans('cruds.bootcampAttendee.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#bootcamp_participant_qr_codes" role="tab" data-toggle="tab">
                {{ trans('cruds.qrCode.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#bootcamp_participant_email_emails" role="tab" data-toggle="tab">
                {{ trans('cruds.email.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="bootcamp_participant_participant_workshop_assignments">
            @includeIf('admin.bootcampParticipants.relationships.bootcampParticipantParticipantWorkshopAssignments', ['participantWorkshopAssignments' => $bootcampParticipant->bootcampParticipantParticipantWorkshopAssignments])
        </div>
        <div class="tab-pane" role="tabpanel" id="bootcamp_participant_participant_workshop_preferences">
            @includeIf('admin.bootcampParticipants.relationships.bootcampParticipantParticipantWorkshopPreferences', ['participantWorkshopPreferences' => $bootcampParticipant->bootcampParticipantParticipantWorkshopPreferences])
        </div>
        <div class="tab-pane" role="tabpanel" id="bootcamp_participant_bootcamp_attendees">
            @includeIf('admin.bootcampParticipants.relationships.bootcampParticipantBootcampAttendees', ['bootcampAttendees' => $bootcampParticipant->bootcampParticipantBootcampAttendees])
        </div>
        <div class="tab-pane" role="tabpanel" id="bootcamp_participant_qr_codes">
            @includeIf('admin.bootcampParticipants.relationships.bootcampParticipantQrCodes', ['qrCodes' => $bootcampParticipant->bootcampParticipantQrCodes])
        </div>
        <div class="tab-pane" role="tabpanel" id="bootcamp_participant_email_emails">
            @includeIf('admin.bootcampParticipants.relationships.bootcampParticipantEmailEmails', ['emails' => $bootcampParticipant->bootcampParticipantEmailEmails])
        </div>
    </div>
</div>

@endsection