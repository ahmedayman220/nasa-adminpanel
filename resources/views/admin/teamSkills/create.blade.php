@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.teamSkill.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.team-skills.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="skill_id">{{ trans('cruds.teamSkill.fields.skill') }}</label>
                <select class="form-control select2 {{ $errors->has('skill') ? 'is-invalid' : '' }}" name="skill_id" id="skill_id" required>
                    @foreach($skills as $id => $entry)
                        <option value="{{ $id }}" {{ old('skill_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('skill'))
                    <div class="invalid-feedback">
                        {{ $errors->first('skill') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.teamSkill.fields.skill_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="proficiency_level">{{ trans('cruds.teamSkill.fields.proficiency_level') }}</label>
                <input class="form-control {{ $errors->has('proficiency_level') ? 'is-invalid' : '' }}" type="number" name="proficiency_level" id="proficiency_level" value="{{ old('proficiency_level', '') }}" step="0.01" required>
                @if($errors->has('proficiency_level'))
                    <div class="invalid-feedback">
                        {{ $errors->first('proficiency_level') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.teamSkill.fields.proficiency_level_helper') }}</span>
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