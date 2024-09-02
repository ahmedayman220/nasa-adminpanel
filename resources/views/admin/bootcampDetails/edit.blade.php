@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.bootcampDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bootcamp-details.update", [$bootcampDetail->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.bootcampDetail.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $bootcampDetail->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampDetail.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.bootcampDetail.fields.date') }}</label>
                <input class="form-control datetime {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $bootcampDetail->date) }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampDetail.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_capacity">{{ trans('cruds.bootcampDetail.fields.total_capacity') }}</label>
                <input class="form-control {{ $errors->has('total_capacity') ? 'is-invalid' : '' }}" type="number" name="total_capacity" id="total_capacity" value="{{ old('total_capacity', $bootcampDetail->total_capacity) }}" step="1" required>
                @if($errors->has('total_capacity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_capacity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampDetail.fields.total_capacity_helper') }}</span>
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