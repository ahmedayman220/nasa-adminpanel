@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.qrCode.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.qr-codes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="bootcamp_participant_id">{{ trans('cruds.qrCode.fields.bootcamp_participant') }}</label>
                <select class="form-control select2 {{ $errors->has('bootcamp_participant') ? 'is-invalid' : '' }}" name="bootcamp_participant_id" id="bootcamp_participant_id" required>
                    @foreach($bootcamp_participants as $id => $entry)
                        <option value="{{ $id }}" {{ old('bootcamp_participant_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bootcamp_participant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bootcamp_participant') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.qrCode.fields.bootcamp_participant_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="qr_code_value">{{ trans('cruds.qrCode.fields.qr_code_value') }}</label>
                <input class="form-control {{ $errors->has('qr_code_value') ? 'is-invalid' : '' }}" type="text" name="qr_code_value" id="qr_code_value" value="{{ old('qr_code_value', '') }}" required>
                @if($errors->has('qr_code_value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qr_code_value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.qrCode.fields.qr_code_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.qrCode.fields.status') }}</label>
                @foreach(App\Models\QrCode::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', '0') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.qrCode.fields.status_helper') }}</span>
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