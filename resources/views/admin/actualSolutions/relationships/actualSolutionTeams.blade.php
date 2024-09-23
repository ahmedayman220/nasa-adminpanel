@can('team_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.teams.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.team.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.team.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-actualSolutionTeams">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.team.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.uuid') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.team_leader') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.team_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.challenge') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.actual_solution') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.mentorship_needed') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.participation_method') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.team_photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.limited_capacity') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.members_participated_before') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.project_proposal_url') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.project_video_url') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.team_rating') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.total_score') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.submission_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.team.fields.extra_field') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teams as $key => $team)
                        <tr data-entry-id="{{ $team->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $team->id ?? '' }}
                            </td>
                            <td>
                                {{ $team->uuid ?? '' }}
                            </td>
                            <td>
                                {{ $team->team_leader->name ?? '' }}
                            </td>
                            <td>
                                {{ $team->team_leader->email ?? '' }}
                            </td>
                            <td>
                                {{ $team->team_name ?? '' }}
                            </td>
                            <td>
                                {{ $team->challenge->title ?? '' }}
                            </td>
                            <td>
                                {{ $team->actual_solution->title ?? '' }}
                            </td>
                            <td>
                                {{ $team->mentorship_needed->title ?? '' }}
                            </td>
                            <td>
                                {{ $team->participation_method->title ?? '' }}
                            </td>
                            <td>
                                @if($team->team_photo)
                                    <a href="{{ $team->team_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $team->team_photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                <span style="display:none">{{ $team->limited_capacity ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $team->limited_capacity ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $team->members_participated_before ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $team->members_participated_before ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $team->project_proposal_url ?? '' }}
                            </td>
                            <td>
                                {{ $team->project_video_url ?? '' }}
                            </td>
                            <td>
                                {{ $team->team_rating ?? '' }}
                            </td>
                            <td>
                                {{ $team->total_score ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Team::STATUS_SELECT[$team->status] ?? '' }}
                            </td>
                            <td>
                                {{ $team->submission_date ?? '' }}
                            </td>
                            <td>
                                {{ $team->extra_field ?? '' }}
                            </td>
                            <td>
                                @can('team_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.teams.show', $team->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('team_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.teams.edit', $team->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('team_delete')
                                    <form action="{{ route('admin.teams.destroy', $team->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('team_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.teams.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-actualSolutionTeams:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection