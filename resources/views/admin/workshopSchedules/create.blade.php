@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.workshopSchedule.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.workshop-schedules.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="workshop_id">{{ trans('cruds.workshopSchedule.fields.workshop') }}</label>
                <select class="form-control select2 {{ $errors->has('workshop') ? 'is-invalid' : '' }}" name="workshop_id" id="workshop_id" required>
                    @foreach($workshops as $id => $entry)
                        <option value="{{ $id }}" {{ old('workshop_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('workshop'))
                    <div class="invalid-feedback">
                        {{ $errors->first('workshop') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workshopSchedule.fields.workshop_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="schedule_time">{{ trans('cruds.workshopSchedule.fields.schedule_time') }}</label>
                <input class="form-control {{ $errors->has('schedule_time') ? 'is-invalid' : '' }}" type="text" name="schedule_time" id="schedule_time" value="{{ old('schedule_time', '') }}" required>
                @if($errors->has('schedule_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('schedule_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workshopSchedule.fields.schedule_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="capacity">{{ trans('cruds.workshopSchedule.fields.capacity') }}</label>
                <input class="form-control {{ $errors->has('capacity') ? 'is-invalid' : '' }}" type="number" name="capacity" id="capacity" value="{{ old('capacity', '') }}" step="1" required>
                @if($errors->has('capacity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('capacity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workshopSchedule.fields.capacity_helper') }}</span>
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