@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.participantWorkshopPreference.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.participant-workshop-preferences.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="bootcamp_participant_id">{{ trans('cruds.participantWorkshopPreference.fields.bootcamp_participant') }}</label>
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
                <span class="help-block">{{ trans('cruds.participantWorkshopPreference.fields.bootcamp_participant_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="workshop_id">{{ trans('cruds.participantWorkshopPreference.fields.workshop') }}</label>
                <select class="form-control select2 {{ $errors->has('workshop') ? 'is-invalid' : '' }}" name="workshop_id" id="workshop_id" required>
                    @foreach($workshops as $id => $entry)
                        <option value="{{ $id }}" {{ old('workshop_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('workshop'))
                    <div class="invalid-feedback">
                        {{ $errors->first('workshop') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.participantWorkshopPreference.fields.workshop_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.participantWorkshopPreference.fields.preference_order') }}</label>
                <select class="form-control {{ $errors->has('preference_order') ? 'is-invalid' : '' }}" name="preference_order" id="preference_order">
                    <option value disabled {{ old('preference_order', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ParticipantWorkshopPreference::PREFERENCE_ORDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('preference_order', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('preference_order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('preference_order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.participantWorkshopPreference.fields.preference_order_helper') }}</span>
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