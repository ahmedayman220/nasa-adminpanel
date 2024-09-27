@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.userChallenge.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-challenges.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="users">{{ trans('cruds.userChallenge.fields.user') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('users') ? 'is-invalid' : '' }}" name="users[]" id="users" multiple required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ in_array($id, old('users', [])) ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('users'))
                    <div class="invalid-feedback">
                        {{ $errors->first('users') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userChallenge.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="challenges">{{ trans('cruds.userChallenge.fields.challenge') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('challenges') ? 'is-invalid' : '' }}" name="challenges[]" id="challenges" multiple required>
                    @foreach($challenges as $id => $challenge)
                        <option value="{{ $id }}" {{ in_array($id, old('challenges', [])) ? 'selected' : '' }}>{{ $challenge }}</option>
                    @endforeach
                </select>
                @if($errors->has('challenges'))
                    <div class="invalid-feedback">
                        {{ $errors->first('challenges') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userChallenge.fields.challenge_helper') }}</span>
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