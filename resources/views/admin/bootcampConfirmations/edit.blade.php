@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.bootcampConfirmation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bootcamp-confirmations.update", [$bootcampConfirmation->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.bootcampConfirmation.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $bootcampConfirmation->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampConfirmation.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email_id">{{ trans('cruds.bootcampConfirmation.fields.email') }}</label>
                <select class="form-control select2 {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email_id" id="email_id" required>
                    @foreach($emails as $id => $entry)
                        <option value="{{ $id }}" {{ (old('email_id') ? old('email_id') : $bootcampConfirmation->email->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampConfirmation.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="national_id">{{ trans('cruds.bootcampConfirmation.fields.national') }}</label>
                <select class="form-control select2 {{ $errors->has('national') ? 'is-invalid' : '' }}" name="national_id" id="national_id" required>
                    @foreach($nationals as $id => $entry)
                        <option value="{{ $id }}" {{ (old('national_id') ? old('national_id') : $bootcampConfirmation->national->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('national'))
                    <div class="invalid-feedback">
                        {{ $errors->first('national') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampConfirmation.fields.national_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number">{{ trans('cruds.bootcampConfirmation.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $bootcampConfirmation->phone_number) }}" required>
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampConfirmation.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="slot_id">{{ trans('cruds.bootcampConfirmation.fields.slot') }}</label>
                <select class="form-control select2 {{ $errors->has('slot') ? 'is-invalid' : '' }}" name="slot_id" id="slot_id">
                    @foreach($slots as $id => $entry)
                        <option value="{{ $id }}" {{ (old('slot_id') ? old('slot_id') : $bootcampConfirmation->slot->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('slot'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slot') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampConfirmation.fields.slot_helper') }}</span>
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