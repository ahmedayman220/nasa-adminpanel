@can('workshop_schedule_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.workshop-schedules.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.workshopSchedule.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.workshopSchedule.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-workshopWorkshopSchedules">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.workshopSchedule.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.workshopSchedule.fields.workshop') }}
                        </th>
                        <th>
                            {{ trans('cruds.workshopSchedule.fields.schedule_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.workshopSchedule.fields.capacity') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($workshopSchedules as $key => $workshopSchedule)
                        <tr data-entry-id="{{ $workshopSchedule->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $workshopSchedule->id ?? '' }}
                            </td>
                            <td>
                                {{ $workshopSchedule->workshop->title ?? '' }}
                            </td>
                            <td>
                                {{ $workshopSchedule->schedule_time ?? '' }}
                            </td>
                            <td>
                                {{ $workshopSchedule->capacity ?? '' }}
                            </td>
                            <td>
                                @can('workshop_schedule_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.workshop-schedules.show', $workshopSchedule->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('workshop_schedule_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.workshop-schedules.edit', $workshopSchedule->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('workshop_schedule_delete')
                                    <form action="{{ route('admin.workshop-schedules.destroy', $workshopSchedule->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('workshop_schedule_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.workshop-schedules.massDestroy') }}",
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
  let table = $('.datatable-workshopWorkshopSchedules:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection