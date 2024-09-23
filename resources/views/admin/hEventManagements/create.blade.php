@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.hEventManagement.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.h-event-managements.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="test">{{ trans('cruds.hEventManagement.fields.test') }}</label>
                <input class="form-control {{ $errors->has('test') ? 'is-invalid' : '' }}" type="text" name="test" id="test" value="{{ old('test', '') }}">
                @if($errors->has('test'))
                    <div class="invalid-feedback">
                        {{ $errors->first('test') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hEventManagement.fields.test_helper') }}</span>
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