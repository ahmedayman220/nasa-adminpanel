@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.email.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.emails.update", [$email->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="qrcode_id">{{ trans('cruds.email.fields.qrcode') }}</label>
                <select class="form-control select2 {{ $errors->has('qrcode') ? 'is-invalid' : '' }}" name="qrcode_id" id="qrcode_id" required>
                    @foreach($qrcodes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('qrcode_id') ? old('qrcode_id') : $email->qrcode->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('qrcode'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qrcode') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.email.fields.qrcode_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.email.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Email::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $email->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.email.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bootcamp_participant_email_id">{{ trans('cruds.email.fields.bootcamp_participant_email') }}</label>
                <select class="form-control select2 {{ $errors->has('bootcamp_participant_email') ? 'is-invalid' : '' }}" name="bootcamp_participant_email_id" id="bootcamp_participant_email_id" required>
                    @foreach($bootcamp_participant_emails as $id => $entry)
                        <option value="{{ $id }}" {{ (old('bootcamp_participant_email_id') ? old('bootcamp_participant_email_id') : $email->bootcamp_participant_email->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bootcamp_participant_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bootcamp_participant_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.email.fields.bootcamp_participant_email_helper') }}</span>
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