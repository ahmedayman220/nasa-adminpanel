@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.team.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.teams.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="uuid">{{ trans('cruds.team.fields.uuid') }}</label>
                <input class="form-control {{ $errors->has('uuid') ? 'is-invalid' : '' }}" type="text" name="uuid" id="uuid" value="{{ old('uuid', '') }}" required>
                @if($errors->has('uuid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('uuid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.uuid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="team_leader_id">{{ trans('cruds.team.fields.team_leader') }}</label>
                <select class="form-control select2 {{ $errors->has('team_leader') ? 'is-invalid' : '' }}" name="team_leader_id" id="team_leader_id" required>
                    @foreach($team_leaders as $id => $entry)
                        <option value="{{ $id }}" {{ old('team_leader_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('team_leader'))
                    <div class="invalid-feedback">
                        {{ $errors->first('team_leader') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.team_leader_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="team_name">{{ trans('cruds.team.fields.team_name') }}</label>
                <input class="form-control {{ $errors->has('team_name') ? 'is-invalid' : '' }}" type="text" name="team_name" id="team_name" value="{{ old('team_name', '') }}" required>
                @if($errors->has('team_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('team_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.team_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="challenge_id">{{ trans('cruds.team.fields.challenge') }}</label>
                <select class="form-control select2 {{ $errors->has('challenge') ? 'is-invalid' : '' }}" name="challenge_id" id="challenge_id" required>
                    @foreach($challenges as $id => $entry)
                        <option value="{{ $id }}" {{ old('challenge_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('challenge'))
                    <div class="invalid-feedback">
                        {{ $errors->first('challenge') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.challenge_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="actual_solution_id">{{ trans('cruds.team.fields.actual_solution') }}</label>
                <select class="form-control select2 {{ $errors->has('actual_solution') ? 'is-invalid' : '' }}" name="actual_solution_id" id="actual_solution_id" required>
                    @foreach($actual_solutions as $id => $entry)
                        <option value="{{ $id }}" {{ old('actual_solution_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('actual_solution'))
                    <div class="invalid-feedback">
                        {{ $errors->first('actual_solution') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.actual_solution_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mentorship_needed_id">{{ trans('cruds.team.fields.mentorship_needed') }}</label>
                <select class="form-control select2 {{ $errors->has('mentorship_needed') ? 'is-invalid' : '' }}" name="mentorship_needed_id" id="mentorship_needed_id" required>
                    @foreach($mentorship_neededs as $id => $entry)
                        <option value="{{ $id }}" {{ old('mentorship_needed_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('mentorship_needed'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mentorship_needed') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.mentorship_needed_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="participation_method_id">{{ trans('cruds.team.fields.participation_method') }}</label>
                <select class="form-control select2 {{ $errors->has('participation_method') ? 'is-invalid' : '' }}" name="participation_method_id" id="participation_method_id" required>
                    @foreach($participation_methods as $id => $entry)
                        <option value="{{ $id }}" {{ old('participation_method_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('participation_method'))
                    <div class="invalid-feedback">
                        {{ $errors->first('participation_method') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.participation_method_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('limited_capacity') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="limited_capacity" id="limited_capacity" value="1" required {{ old('limited_capacity', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="limited_capacity">{{ trans('cruds.team.fields.limited_capacity') }}</label>
                </div>
                @if($errors->has('limited_capacity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('limited_capacity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.limited_capacity_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('members_participated_before') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="members_participated_before" id="members_participated_before" value="1" required {{ old('members_participated_before', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="members_participated_before">{{ trans('cruds.team.fields.members_participated_before') }}</label>
                </div>
                @if($errors->has('members_participated_before'))
                    <div class="invalid-feedback">
                        {{ $errors->first('members_participated_before') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.members_participated_before_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="project_proposal_url">{{ trans('cruds.team.fields.project_proposal_url') }}</label>
                <input class="form-control {{ $errors->has('project_proposal_url') ? 'is-invalid' : '' }}" type="text" name="project_proposal_url" id="project_proposal_url" value="{{ old('project_proposal_url', '') }}" required>
                @if($errors->has('project_proposal_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('project_proposal_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.project_proposal_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="project_video_url">{{ trans('cruds.team.fields.project_video_url') }}</label>
                <input class="form-control {{ $errors->has('project_video_url') ? 'is-invalid' : '' }}" type="text" name="project_video_url" id="project_video_url" value="{{ old('project_video_url', '') }}" required>
                @if($errors->has('project_video_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('project_video_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.project_video_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="team_rating">{{ trans('cruds.team.fields.team_rating') }}</label>
                <input class="form-control {{ $errors->has('team_rating') ? 'is-invalid' : '' }}" type="number" name="team_rating" id="team_rating" value="{{ old('team_rating', '') }}" step="0.01">
                @if($errors->has('team_rating'))
                    <div class="invalid-feedback">
                        {{ $errors->first('team_rating') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.team_rating_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_score">{{ trans('cruds.team.fields.total_score') }}</label>
                <input class="form-control {{ $errors->has('total_score') ? 'is-invalid' : '' }}" type="number" name="total_score" id="total_score" value="{{ old('total_score', '') }}" step="0.01">
                @if($errors->has('total_score'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_score') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.total_score_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.team.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Team::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'accepted') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="submission_date">{{ trans('cruds.team.fields.submission_date') }}</label>
                <input class="form-control datetime {{ $errors->has('submission_date') ? 'is-invalid' : '' }}" type="text" name="submission_date" id="submission_date" value="{{ old('submission_date') }}">
                @if($errors->has('submission_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('submission_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.submission_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nots">{{ trans('cruds.team.fields.nots') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('nots') ? 'is-invalid' : '' }}" name="nots" id="nots">{!! old('nots') !!}</textarea>
                @if($errors->has('nots'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nots') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.nots_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="extra_field">{{ trans('cruds.team.fields.extra_field') }}</label>
                <input class="form-control {{ $errors->has('extra_field') ? 'is-invalid' : '' }}" type="text" name="extra_field" id="extra_field" value="{{ old('extra_field', '') }}">
                @if($errors->has('extra_field'))
                    <div class="invalid-feedback">
                        {{ $errors->first('extra_field') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.extra_field_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.team.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.description_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.teams.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $team->id ?? 0 }}');
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