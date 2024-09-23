@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.teamAchievement.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.team-achievements.update", [$teamAchievement->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="achievement_id">{{ trans('cruds.teamAchievement.fields.achievement') }}</label>
                <select class="form-control select2 {{ $errors->has('achievement') ? 'is-invalid' : '' }}" name="achievement_id" id="achievement_id">
                    @foreach($achievements as $id => $entry)
                        <option value="{{ $id }}" {{ (old('achievement_id') ? old('achievement_id') : $teamAchievement->achievement->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('achievement'))
                    <div class="invalid-feedback">
                        {{ $errors->first('achievement') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.teamAchievement.fields.achievement_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="earned_at">{{ trans('cruds.teamAchievement.fields.earned_at') }}</label>
                <input class="form-control datetime {{ $errors->has('earned_at') ? 'is-invalid' : '' }}" type="text" name="earned_at" id="earned_at" value="{{ old('earned_at', $teamAchievement->earned_at) }}">
                @if($errors->has('earned_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('earned_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.teamAchievement.fields.earned_at_helper') }}</span>
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