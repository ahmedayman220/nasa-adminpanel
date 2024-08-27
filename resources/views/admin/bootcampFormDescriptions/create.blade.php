@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bootcampFormDescription.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bootcamp-form-descriptions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="section_1_title">{{ trans('cruds.bootcampFormDescription.fields.section_1_title') }}</label>
                <input class="form-control {{ $errors->has('section_1_title') ? 'is-invalid' : '' }}" type="text" name="section_1_title" id="section_1_title" value="{{ old('section_1_title', '') }}">
                @if($errors->has('section_1_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('section_1_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampFormDescription.fields.section_1_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="section_1_description">{{ trans('cruds.bootcampFormDescription.fields.section_1_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('section_1_description') ? 'is-invalid' : '' }}" name="section_1_description" id="section_1_description">{!! old('section_1_description') !!}</textarea>
                @if($errors->has('section_1_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('section_1_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampFormDescription.fields.section_1_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="national_id_front_description">{{ trans('cruds.bootcampFormDescription.fields.national_id_front_description') }}</label>
                <textarea class="form-control {{ $errors->has('national_id_front_description') ? 'is-invalid' : '' }}" name="national_id_front_description" id="national_id_front_description">{{ old('national_id_front_description') }}</textarea>
                @if($errors->has('national_id_front_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('national_id_front_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampFormDescription.fields.national_id_front_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="national_id_back_description">{{ trans('cruds.bootcampFormDescription.fields.national_id_back_description') }}</label>
                <textarea class="form-control {{ $errors->has('national_id_back_description') ? 'is-invalid' : '' }}" name="national_id_back_description" id="national_id_back_description">{{ old('national_id_back_description') }}</textarea>
                @if($errors->has('national_id_back_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('national_id_back_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampFormDescription.fields.national_id_back_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="section_2_title">{{ trans('cruds.bootcampFormDescription.fields.section_2_title') }}</label>
                <input class="form-control {{ $errors->has('section_2_title') ? 'is-invalid' : '' }}" type="text" name="section_2_title" id="section_2_title" value="{{ old('section_2_title', '') }}">
                @if($errors->has('section_2_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('section_2_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bootcampFormDescription.fields.section_2_title_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.bootcamp-form-descriptions.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $bootcampFormDescription->id ?? 0 }}');
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