@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bootcampParticipant.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bootcamp-participants.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name_en">{{ trans('cruds.bootcampParticipant.fields.name_en') }}</label>
                <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" id="name_en" value="{{ old('name_en', '') }}" required>
                @if($errors->has('name_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.name_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name_ar">{{ trans('cruds.bootcampParticipant.fields.name_ar') }}</label>
                <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', '') }}" required>
                @if($errors->has('name_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.name_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.bootcampParticipant.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="age">{{ trans('cruds.bootcampParticipant.fields.age') }}</label>
                <input class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" type="text" name="age" id="age" value="{{ old('age', '') }}" required>
                @if($errors->has('age'))
                    <div class="invalid-feedback">
                        {{ $errors->first('age') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.age_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number">{{ trans('cruds.bootcampParticipant.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}" required>
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="educational_level_id">{{ trans('cruds.bootcampParticipant.fields.educational_level') }}</label>
                <select class="form-control select2 {{ $errors->has('educational_level') ? 'is-invalid' : '' }}" name="educational_level_id" id="educational_level_id" required>
                    @foreach($educational_levels as $id => $entry)
                        <option value="{{ $id }}" {{ old('educational_level_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('educational_level'))
                    <div class="invalid-feedback">
                        {{ $errors->first('educational_level') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.educational_level_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_of_study_id">{{ trans('cruds.bootcampParticipant.fields.field_of_study') }}</label>
                <select class="form-control select2 {{ $errors->has('field_of_study') ? 'is-invalid' : '' }}" name="field_of_study_id" id="field_of_study_id" required>
                    @foreach($field_of_studies as $id => $entry)
                        <option value="{{ $id }}" {{ old('field_of_study_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_of_study'))
                    <div class="invalid-feedback">
                        {{ $errors->first('field_of_study') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.field_of_study_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="educational_institute">{{ trans('cruds.bootcampParticipant.fields.educational_institute') }}</label>
                <input class="form-control {{ $errors->has('educational_institute') ? 'is-invalid' : '' }}" type="text" name="educational_institute" id="educational_institute" value="{{ old('educational_institute', '') }}" required>
                @if($errors->has('educational_institute'))
                    <div class="invalid-feedback">
                        {{ $errors->first('educational_institute') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.educational_institute_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="graduation_year">{{ trans('cruds.bootcampParticipant.fields.graduation_year') }}</label>
                <input class="form-control {{ $errors->has('graduation_year') ? 'is-invalid' : '' }}" type="text" name="graduation_year" id="graduation_year" value="{{ old('graduation_year', '') }}" required>
                @if($errors->has('graduation_year'))
                    <div class="invalid-feedback">
                        {{ $errors->first('graduation_year') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.graduation_year_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="position">{{ trans('cruds.bootcampParticipant.fields.position') }}</label>
                <input class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}" type="text" name="position" id="position" value="{{ old('position', '') }}" required>
                @if($errors->has('position'))
                    <div class="invalid-feedback">
                        {{ $errors->first('position') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.position_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="national">{{ trans('cruds.bootcampParticipant.fields.national') }}</label>
                <input class="form-control {{ $errors->has('national') ? 'is-invalid' : '' }}" type="text" name="national" id="national" value="{{ old('national', '') }}" required>
                @if($errors->has('national'))
                    <div class="invalid-feedback">
                        {{ $errors->first('national') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.national_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="national_id_front">{{ trans('cruds.bootcampParticipant.fields.national_id_front') }}</label>
                <div class="needsclick dropzone {{ $errors->has('national_id_front') ? 'is-invalid' : '' }}" id="national_id_front-dropzone">
                </div>
                @if($errors->has('national_id_front'))
                    <div class="invalid-feedback">
                        {{ $errors->first('national_id_front') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.national_id_front_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="national_id_back">{{ trans('cruds.bootcampParticipant.fields.national_id_back') }}</label>
                <div class="needsclick dropzone {{ $errors->has('national_id_back') ? 'is-invalid' : '' }}" id="national_id_back-dropzone">
                </div>
                @if($errors->has('national_id_back'))
                    <div class="invalid-feedback">
                        {{ $errors->first('national_id_back') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.national_id_back_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.bootcampParticipant.fields.is_participated') }}</label>
                @foreach(App\Models\BootcampParticipant::IS_PARTICIPATED_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('is_participated') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="is_participated_{{ $key }}" name="is_participated" value="{{ $key }}" {{ old('is_participated', '0') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="is_participated_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('is_participated'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_participated') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.is_participated_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="participated_year">{{ trans('cruds.bootcampParticipant.fields.participated_year') }}</label>
                <input class="form-control {{ $errors->has('participated_year') ? 'is-invalid' : '' }}" type="text" name="participated_year" id="participated_year" value="{{ old('participated_year', '') }}">
                @if($errors->has('participated_year'))
                    <div class="invalid-feedback">
                        {{ $errors->first('participated_year') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.participated_year_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.bootcampParticipant.fields.is_attend_formation_activity') }}</label>
                @foreach(App\Models\BootcampParticipant::IS_ATTEND_FORMATION_ACTIVITY_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('is_attend_formation_activity') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="is_attend_formation_activity_{{ $key }}" name="is_attend_formation_activity" value="{{ $key }}" {{ old('is_attend_formation_activity', '0') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="is_attend_formation_activity_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('is_attend_formation_activity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_attend_formation_activity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.is_attend_formation_activity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="first_priority_id">{{ trans('cruds.bootcampParticipant.fields.first_priority') }}</label>
                <select class="form-control select2 {{ $errors->has('first_priority') ? 'is-invalid' : '' }}" name="first_priority_id" id="first_priority_id" required>
                    @foreach($first_priorities as $id => $entry)
                        <option value="{{ $id }}" {{ old('first_priority_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('first_priority'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_priority') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.first_priority_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="second_priority_id">{{ trans('cruds.bootcampParticipant.fields.second_priority') }}</label>
                <select class="form-control select2 {{ $errors->has('second_priority') ? 'is-invalid' : '' }}" name="second_priority_id" id="second_priority_id">
                    @foreach($second_priorities as $id => $entry)
                        <option value="{{ $id }}" {{ old('second_priority_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('second_priority'))
                    <div class="invalid-feedback">
                        {{ $errors->first('second_priority') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.second_priority_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="third_priority_id">{{ trans('cruds.bootcampParticipant.fields.third_priority') }}</label>
                <select class="form-control select2 {{ $errors->has('third_priority') ? 'is-invalid' : '' }}" name="third_priority_id" id="third_priority_id">
                    @foreach($third_priorities as $id => $entry)
                        <option value="{{ $id }}" {{ old('third_priority_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('third_priority'))
                    <div class="invalid-feedback">
                        {{ $errors->first('third_priority') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.third_priority_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="why_this_workshop">{{ trans('cruds.bootcampParticipant.fields.why_this_workshop') }}</label>
                <input class="form-control {{ $errors->has('why_this_workshop') ? 'is-invalid' : '' }}" type="text" name="why_this_workshop" id="why_this_workshop" value="{{ old('why_this_workshop', '') }}" required>
                @if($errors->has('why_this_workshop'))
                    <div class="invalid-feedback">
                        {{ $errors->first('why_this_workshop') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.why_this_workshop_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.bootcampParticipant.fields.is_have_team') }}</label>
                @foreach(App\Models\BootcampParticipant::IS_HAVE_TEAM_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('is_have_team') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="is_have_team_{{ $key }}" name="is_have_team" value="{{ $key }}" {{ old('is_have_team', '0') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="is_have_team_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('is_have_team'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_have_team') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.is_have_team_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="comment">{{ trans('cruds.bootcampParticipant.fields.comment') }}</label>
                <input class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" type="text" name="comment" id="comment" value="{{ old('comment', '') }}" required>
                @if($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="year">{{ trans('cruds.bootcampParticipant.fields.year') }}</label>
                <input class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" type="text" name="year" id="year" value="{{ old('year', '') }}" required>
                @if($errors->has('year'))
                    <div class="invalid-feedback">
                        {{ $errors->first('year') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampParticipant.fields.year_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.nationalIdFrontDropzone = {
    url: '{{ route('admin.bootcamp-participants.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="national_id_front"]').remove()
      $('form').append('<input type="hidden" name="national_id_front" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="national_id_front"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($bootcampParticipant) && $bootcampParticipant->national_id_front)
      var file = {!! json_encode($bootcampParticipant->national_id_front) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="national_id_front" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
<script>
    Dropzone.options.nationalIdBackDropzone = {
    url: '{{ route('admin.bootcamp-participants.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="national_id_back"]').remove()
      $('form').append('<input type="hidden" name="national_id_back" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="national_id_back"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($bootcampParticipant) && $bootcampParticipant->national_id_back)
      var file = {!! json_encode($bootcampParticipant->national_id_back) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="national_id_back" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection