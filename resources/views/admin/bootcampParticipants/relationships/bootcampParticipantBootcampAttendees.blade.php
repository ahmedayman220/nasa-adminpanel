@can('bootcamp_attendee_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.bootcamp-attendees.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bootcampAttendee.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.bootcampAttendee.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-bootcampParticipantBootcampAttendees">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.bootcampAttendee.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampAttendee.fields.bootcamp_details') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampAttendee.fields.bootcamp_participant') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampAttendee.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampAttendee.fields.attendance_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampAttendee.fields.check_in_time') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bootcampAttendees as $key => $bootcampAttendee)
                        <tr data-entry-id="{{ $bootcampAttendee->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $bootcampAttendee->id ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampAttendee->bootcamp_details->name ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampAttendee->bootcamp_participant->name_en ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\BootcampAttendee::CATEGORY_RADIO[$bootcampAttendee->category] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\BootcampAttendee::ATTENDANCE_STATUS_RADIO[$bootcampAttendee->attendance_status] ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampAttendee->check_in_time ?? '' }}
                            </td>
                            <td>
                                @can('bootcamp_attendee_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.bootcamp-attendees.show', $bootcampAttendee->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('bootcamp_attendee_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.bootcamp-attendees.edit', $bootcampAttendee->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('bootcamp_attendee_delete')
                                    <form action="{{ route('admin.bootcamp-attendees.destroy', $bootcampAttendee->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bootcamp_attendee_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bootcamp-attendees.massDestroy') }}",
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
  let table = $('.datatable-bootcampParticipantBootcampAttendees:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection