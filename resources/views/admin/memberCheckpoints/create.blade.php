@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.memberCheckpoint.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.member-checkpoints.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="member_id">{{ trans('cruds.memberCheckpoint.fields.member') }}</label>
                <select class="form-control select2 {{ $errors->has('member') ? 'is-invalid' : '' }}" name="member_id" id="member_id" required>
                    @foreach($members as $id => $entry)
                        <option value="{{ $id }}" {{ old('member_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('member'))
                    <div class="invalid-feedback">
                        {{ $errors->first('member') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.memberCheckpoint.fields.member_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="checkpoint_id">{{ trans('cruds.memberCheckpoint.fields.checkpoint') }}</label>
                <select class="form-control select2 {{ $errors->has('checkpoint') ? 'is-invalid' : '' }}" name="checkpoint_id" id="checkpoint_id" required>
                    @foreach($checkpoints as $id => $entry)
                        <option value="{{ $id }}" {{ old('checkpoint_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('checkpoint'))
                    <div class="invalid-feedback">
                        {{ $errors->first('checkpoint') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.memberCheckpoint.fields.checkpoint_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('completed') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="completed" value="0">
                    <input class="form-check-input" type="checkbox" name="completed" id="completed" value="1" {{ old('completed', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="completed">{{ trans('cruds.memberCheckpoint.fields.completed') }}</label>
                </div>
                @if($errors->has('completed'))
                    <div class="invalid-feedback">
                        {{ $errors->first('completed') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.memberCheckpoint.fields.completed_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="completion_time">{{ trans('cruds.memberCheckpoint.fields.completion_time') }}</label>
                <input class="form-control datetime {{ $errors->has('completion_time') ? 'is-invalid' : '' }}" type="text" name="completion_time" id="completion_time" value="{{ old('completion_time') }}">
                @if($errors->has('completion_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('completion_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.memberCheckpoint.fields.completion_time_helper') }}</span>
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