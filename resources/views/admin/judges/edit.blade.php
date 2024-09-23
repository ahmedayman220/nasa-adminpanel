@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.judge.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.judges.update", [$judge->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.judge.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $judge->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.judge.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="expertise">{{ trans('cruds.judge.fields.expertise') }}</label>
                <input class="form-control {{ $errors->has('expertise') ? 'is-invalid' : '' }}" type="text" name="expertise" id="expertise" value="{{ old('expertise', $judge->expertise) }}" required>
                @if($errors->has('expertise'))
                    <div class="invalid-feedback">
                        {{ $errors->first('expertise') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.judge.fields.expertise_helper') }}</span>
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