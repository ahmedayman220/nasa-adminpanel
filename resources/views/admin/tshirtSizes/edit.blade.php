@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tshirtSize.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tshirt-sizes.update", [$tshirtSize->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.tshirtSize.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $tshirtSize->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tshirtSize.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="extra_field">{{ trans('cruds.tshirtSize.fields.extra_field') }}</label>
                <input class="form-control {{ $errors->has('extra_field') ? 'is-invalid' : '' }}" type="text" name="extra_field" id="extra_field" value="{{ old('extra_field', $tshirtSize->extra_field) }}">
                @if($errors->has('extra_field'))
                    <div class="invalid-feedback">
                        {{ $errors->first('extra_field') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tshirtSize.fields.extra_field_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.tshirtSize.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $tshirtSize->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tshirtSize.fields.description_helper') }}</span>
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