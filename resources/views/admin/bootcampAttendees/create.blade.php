@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bootcampAttendee.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bootcamp-attendees.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="bootcamp_details_id">{{ trans('cruds.bootcampAttendee.fields.bootcamp_details') }}</label>
                <select class="form-control select2 {{ $errors->has('bootcamp_details') ? 'is-invalid' : '' }}" name="bootcamp_details_id" id="bootcamp_details_id" required>
                    @foreach($bootcamp_details as $id => $entry)
                        <option value="{{ $id }}" {{ old('bootcamp_details_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bootcamp_details'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bootcamp_details') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampAttendee.fields.bootcamp_details_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bootcamp_participant_id">{{ trans('cruds.bootcampAttendee.fields.bootcamp_participant') }}</label>
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
                <span class="help-block">{{ trans('cruds.bootcampAttendee.fields.bootcamp_participant_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.bootcampAttendee.fields.category') }}</label>
                @foreach(App\Models\BootcampAttendee::CATEGORY_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('category') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="category_{{ $key }}" name="category" value="{{ $key }}" {{ old('category', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="category_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampAttendee.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.bootcampAttendee.fields.attendance_status') }}</label>
                @foreach(App\Models\BootcampAttendee::ATTENDANCE_STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('attendance_status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="attendance_status_{{ $key }}" name="attendance_status" value="{{ $key }}" {{ old('attendance_status', '0') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="attendance_status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('attendance_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attendance_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampAttendee.fields.attendance_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="check_in_time">{{ trans('cruds.bootcampAttendee.fields.check_in_time') }}</label>
                <input class="form-control datetime {{ $errors->has('check_in_time') ? 'is-invalid' : '' }}" type="text" name="check_in_time" id="check_in_time" value="{{ old('check_in_time') }}">
                @if($errors->has('check_in_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('check_in_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampAttendee.fields.check_in_time_helper') }}</span>
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