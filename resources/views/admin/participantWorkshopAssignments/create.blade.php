@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.participantWorkshopAssignment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.participant-workshop-assignments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="bootcamp_participant_id">{{ trans('cruds.participantWorkshopAssignment.fields.bootcamp_participant') }}</label>
                <select class="form-control select2 {{ $errors->has('bootcamp_participant') ? 'is-invalid' : '' }}" name="bootcamp_participant_id" id="bootcamp_participant_id" required>
                    @foreach($bootcamp_participants as $id => $entry)
                        <option value="{{ $id }}" {{ old('bootcamp_participant_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bootcamp_participant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bootcamp_participant') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.participantWorkshopAssignment.fields.bootcamp_participant_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="workshop_schedule_id">{{ trans('cruds.participantWorkshopAssignment.fields.workshop_schedule') }}</label>
                <select class="form-control select2 {{ $errors->has('workshop_schedule') ? 'is-invalid' : '' }}" name="workshop_schedule_id" id="workshop_schedule_id" required>
                    @foreach($workshop_schedules as $id => $entry)
                        <option value="{{ $id }}" {{ old('workshop_schedule_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('workshop_schedule'))
                    <div class="invalid-feedback">
                        {{ $errors->first('workshop_schedule') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.participantWorkshopAssignment.fields.workshop_schedule_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.participantWorkshopAssignment.fields.attendance_status') }}</label>
                <select class="form-control {{ $errors->has('attendance_status') ? 'is-invalid' : '' }}" name="attendance_status" id="attendance_status" required>
                    <option value disabled {{ old('attendance_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ParticipantWorkshopAssignment::ATTENDANCE_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('attendance_status', 'assigned') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('attendance_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attendance_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.participantWorkshopAssignment.fields.attendance_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="check_in_time">{{ trans('cruds.participantWorkshopAssignment.fields.check_in_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('check_in_time') ? 'is-invalid' : '' }}" type="text" name="check_in_time" id="check_in_time" value="{{ old('check_in_time') }}" required>
                @if($errors->has('check_in_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('check_in_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.participantWorkshopAssignment.fields.check_in_time_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection