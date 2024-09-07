@can('participant_workshop_assignment_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.participant-workshop-assignments.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.participantWorkshopAssignment.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.participantWorkshopAssignment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-workshopScheduleParticipantWorkshopAssignments">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.participantWorkshopAssignment.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.participantWorkshopAssignment.fields.bootcamp_participant') }}
                        </th>
                        <th>
                            {{ trans('cruds.workshopSchedule.fields.workshop') }}
                        </th>
                        <th>
                            {{ trans('cruds.participantWorkshopAssignment.fields.workshop_schedule') }}
                        </th>
                        <th>
                            {{ trans('cruds.participantWorkshopAssignment.fields.attendance_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.participantWorkshopAssignment.fields.check_in_time') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($participantWorkshopAssignments as $key => $participantWorkshopAssignment)
                        <tr data-entry-id="{{ $participantWorkshopAssignment->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $participantWorkshopAssignment->id ?? '' }}
                            </td>
                            <td>
                                {{ $participantWorkshopAssignment->bootcamp_participant->name_en ?? '' }}
                            </td>

                            <td>
                                {{ $participantWorkshopAssignment->workshop_schedule ?? '' }}
                            </td>

                            <td>
                                {{ $participantWorkshopAssignment->workshop_schedule->schedule_time ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\ParticipantWorkshopAssignment::ATTENDANCE_STATUS_SELECT[$participantWorkshopAssignment->attendance_status] ?? '' }}
                            </td>
                            <td>
                                {{ $participantWorkshopAssignment->check_in_time ?? '' }}
                            </td>
                            <td>
                                @can('participant_workshop_assignment_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.participant-workshop-assignments.show', $participantWorkshopAssignment->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('participant_workshop_assignment_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.participant-workshop-assignments.edit', $participantWorkshopAssignment->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('participant_workshop_assignment_delete')
                                    <form action="{{ route('admin.participant-workshop-assignments.destroy', $participantWorkshopAssignment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('participant_workshop_assignment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.participant-workshop-assignments.massDestroy') }}",
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
  let table = $('.datatable-workshopScheduleParticipantWorkshopAssignments:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
