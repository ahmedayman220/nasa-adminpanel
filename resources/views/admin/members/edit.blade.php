@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.member.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.members.update", [$member->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="uuid">{{ trans('cruds.member.fields.uuid') }}</label>
                <input class="form-control {{ $errors->has('uuid') ? 'is-invalid' : '' }}" type="text" name="uuid" id="uuid" value="{{ old('uuid', $member->uuid) }}" required>
                @if($errors->has('uuid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('uuid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.uuid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="national">{{ trans('cruds.member.fields.national') }}</label>
                <input class="form-control {{ $errors->has('national') ? 'is-invalid' : '' }}" type="text" name="national" id="national" value="{{ old('national', $member->national) }}" required>
                @if($errors->has('national'))
                    <div class="invalid-feedback">
                        {{ $errors->first('national') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.national_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.member.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $member->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.member.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $member->email) }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number">{{ trans('cruds.member.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $member->phone_number) }}" required>
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="age">{{ trans('cruds.member.fields.age') }}</label>
                <input class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" type="text" name="age" id="age" value="{{ old('age', $member->age) }}" required>
                @if($errors->has('age'))
                    <div class="invalid-feedback">
                        {{ $errors->first('age') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.age_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nationa_id_photo">{{ trans('cruds.member.fields.nationa_id_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('nationa_id_photo') ? 'is-invalid' : '' }}" id="nationa_id_photo-dropzone">
                </div>
                @if($errors->has('nationa_id_photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nationa_id_photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.nationa_id_photo_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_new') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="is_new" id="is_new" value="1" {{ $member->is_new || old('is_new', 0) === 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label" for="is_new">{{ trans('cruds.member.fields.is_new') }}</label>
                </div>
                @if($errors->has('is_new'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_new') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.is_new_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="major_id">{{ trans('cruds.member.fields.major') }}</label>
                <select class="form-control select2 {{ $errors->has('major') ? 'is-invalid' : '' }}" name="major_id" id="major_id" required>
                    @foreach($majors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('major_id') ? old('major_id') : $member->major->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('major'))
                    <div class="invalid-feedback">
                        {{ $errors->first('major') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.major_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="organization">{{ trans('cruds.member.fields.organization') }}</label>
                <input class="form-control {{ $errors->has('organization') ? 'is-invalid' : '' }}" type="text" name="organization" id="organization" value="{{ old('organization', $member->organization) }}" required>
                @if($errors->has('organization'))
                    <div class="invalid-feedback">
                        {{ $errors->first('organization') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.organization_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.member.fields.participant_type') }}</label>
                <select class="form-control {{ $errors->has('participant_type') ? 'is-invalid' : '' }}" name="participant_type" id="participant_type" required>
                    <option value disabled {{ old('participant_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Member::PARTICIPANT_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('participant_type', $member->participant_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('participant_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('participant_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.participant_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="study_level_id">{{ trans('cruds.member.fields.study_level') }}</label>
                <select class="form-control select2 {{ $errors->has('study_level') ? 'is-invalid' : '' }}" name="study_level_id" id="study_level_id" required>
                    @foreach($study_levels as $id => $entry)
                        <option value="{{ $id }}" {{ (old('study_level_id') ? old('study_level_id') : $member->study_level->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('study_level'))
                    <div class="invalid-feedback">
                        {{ $errors->first('study_level') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.study_level_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tshirt_size_id">{{ trans('cruds.member.fields.tshirt_size') }}</label>
                <select class="form-control select2 {{ $errors->has('tshirt_size') ? 'is-invalid' : '' }}" name="tshirt_size_id" id="tshirt_size_id">
                    @foreach($tshirt_sizes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('tshirt_size_id') ? old('tshirt_size_id') : $member->tshirt_size->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('tshirt_size'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tshirt_size') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.tshirt_size_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qr_code_id">{{ trans('cruds.member.fields.qr_code') }}</label>
                <select class="form-control select2 {{ $errors->has('qr_code') ? 'is-invalid' : '' }}" name="qr_code_id" id="qr_code_id">
                    @foreach($qr_codes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('qr_code_id') ? old('qr_code_id') : $member->qr_code->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('qr_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qr_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.qr_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.member.fields.member_role') }}</label>
                <select class="form-control {{ $errors->has('member_role') ? 'is-invalid' : '' }}" name="member_role" id="member_role">
                    <option value disabled {{ old('member_role', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Member::MEMBER_ROLE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('member_role', $member->member_role) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('member_role'))
                    <div class="invalid-feedback">
                        {{ $errors->first('member_role') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.member_role_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="extra_field">{{ trans('cruds.member.fields.extra_field') }}</label>
                <input class="form-control {{ $errors->has('extra_field') ? 'is-invalid' : '' }}" type="text" name="extra_field" id="extra_field" value="{{ old('extra_field', $member->extra_field) }}">
                @if($errors->has('extra_field'))
                    <div class="invalid-feedback">
                        {{ $errors->first('extra_field') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.extra_field_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.member.fields.notes') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{!! old('notes', $member->notes) !!}</textarea>
                @if($errors->has('notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="transportation_id">{{ trans('cruds.member.fields.transportation') }}</label>
                <select class="form-control select2 {{ $errors->has('transportation') ? 'is-invalid' : '' }}" name="transportation_id" id="transportation_id">
                    @foreach($transportations as $id => $entry)
                        <option value="{{ $id }}" {{ (old('transportation_id') ? old('transportation_id') : $member->transportation->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('transportation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('transportation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.transportation_helper') }}</span>
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
    Dropzone.options.nationaIdPhotoDropzone = {
    url: '{{ route('admin.members.storeMedia') }}',
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
      $('form').find('input[name="nationa_id_photo"]').remove()
      $('form').append('<input type="hidden" name="nationa_id_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="nationa_id_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($member) && $member->nationa_id_photo)
      var file = {!! json_encode($member->nationa_id_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="nationa_id_photo" value="' + file.file_name + '">')
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.members.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $member->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection