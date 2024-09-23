@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.evaluation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.evaluations.update", [$evaluation->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="judge_id">{{ trans('cruds.evaluation.fields.judge') }}</label>
                <select class="form-control select2 {{ $errors->has('judge') ? 'is-invalid' : '' }}" name="judge_id" id="judge_id">
                    @foreach($judges as $id => $entry)
                        <option value="{{ $id }}" {{ (old('judge_id') ? old('judge_id') : $evaluation->judge->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('judge'))
                    <div class="invalid-feedback">
                        {{ $errors->first('judge') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.evaluation.fields.judge_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="score">{{ trans('cruds.evaluation.fields.score') }}</label>
                <input class="form-control {{ $errors->has('score') ? 'is-invalid' : '' }}" type="number" name="score" id="score" value="{{ old('score', $evaluation->score) }}" step="0.01">
                @if($errors->has('score'))
                    <div class="invalid-feedback">
                        {{ $errors->first('score') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.evaluation.fields.score_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="criteria_id">{{ trans('cruds.evaluation.fields.criteria') }}</label>
                <select class="form-control select2 {{ $errors->has('criteria') ? 'is-invalid' : '' }}" name="criteria_id" id="criteria_id">
                    @foreach($criterias as $id => $entry)
                        <option value="{{ $id }}" {{ (old('criteria_id') ? old('criteria_id') : $evaluation->criteria->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('criteria'))
                    <div class="invalid-feedback">
                        {{ $errors->first('criteria') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.evaluation.fields.criteria_helper') }}</span>
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