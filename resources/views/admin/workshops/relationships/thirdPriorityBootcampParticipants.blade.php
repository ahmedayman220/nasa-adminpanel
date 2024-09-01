@can('bootcamp_participant_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.bootcamp-participants.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bootcampParticipant.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.bootcampParticipant.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-thirdPriorityBootcampParticipants">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.name_en') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.name_ar') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.age') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.phone_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.educational_level') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.field_of_study') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.educational_institute') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.graduation_year') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.position') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.national') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.national_id_front') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.national_id_back') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.is_participated') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.participated_year') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.is_attend_formation_activity') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.first_priority') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.second_priority') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.third_priority') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.why_this_workshop') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.is_have_team') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.comment') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.year') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bootcampParticipants as $key => $bootcampParticipant)
                        <tr data-entry-id="{{ $bootcampParticipant->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $bootcampParticipant->id ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->name_en ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->name_ar ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->email ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->age ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->phone_number ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->educational_level->title ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->field_of_study->title ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->educational_institute ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->graduation_year ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->position ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->national ?? '' }}
                            </td>
                            <td>
                                @if($bootcampParticipant->national_id_front)
                                    <a href="{{ $bootcampParticipant->national_id_front->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $bootcampParticipant->national_id_front->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($bootcampParticipant->national_id_back)
                                    <a href="{{ $bootcampParticipant->national_id_back->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $bootcampParticipant->national_id_back->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ App\Models\BootcampParticipant::IS_PARTICIPATED_RADIO[$bootcampParticipant->is_participated] ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->participated_year ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\BootcampParticipant::IS_ATTEND_FORMATION_ACTIVITY_RADIO[$bootcampParticipant->is_attend_formation_activity] ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->first_priority->title ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->second_priority->title ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->third_priority->title ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->why_this_workshop ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\BootcampParticipant::IS_HAVE_TEAM_RADIO[$bootcampParticipant->is_have_team] ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->comment ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampParticipant->year ?? '' }}
                            </td>
                            <td>
                                @can('bootcamp_participant_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.bootcamp-participants.show', $bootcampParticipant->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('bootcamp_participant_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.bootcamp-participants.edit', $bootcampParticipant->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('bootcamp_participant_delete')
                                    <form action="{{ route('admin.bootcamp-participants.destroy', $bootcampParticipant->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bootcamp_participant_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bootcamp-participants.massDestroy') }}",
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
    order: [[ 10, 'asc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-thirdPriorityBootcampParticipants:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection