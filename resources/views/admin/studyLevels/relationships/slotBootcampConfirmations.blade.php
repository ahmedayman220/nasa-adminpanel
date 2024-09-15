@can('bootcamp_confirmation_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.bootcamp-confirmations.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bootcampConfirmation.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.bootcampConfirmation.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-slotBootcampConfirmations">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.bootcampConfirmation.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampConfirmation.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampConfirmation.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampConfirmation.fields.national') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampParticipant.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampConfirmation.fields.phone_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.bootcampConfirmation.fields.slot') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bootcampConfirmations as $key => $bootcampConfirmation)
                        <tr data-entry-id="{{ $bootcampConfirmation->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $bootcampConfirmation->id ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampConfirmation->name ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampConfirmation->email->name_en ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampConfirmation->national->name_en ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampConfirmation->national->email ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampConfirmation->phone_number ?? '' }}
                            </td>
                            <td>
                                {{ $bootcampConfirmation->slot->title ?? '' }}
                            </td>
                            <td>
                                @can('bootcamp_confirmation_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.bootcamp-confirmations.show', $bootcampConfirmation->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('bootcamp_confirmation_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.bootcamp-confirmations.edit', $bootcampConfirmation->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('bootcamp_confirmation_delete')
                                    <form action="{{ route('admin.bootcamp-confirmations.destroy', $bootcampConfirmation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bootcamp_confirmation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bootcamp-confirmations.massDestroy') }}",
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
  let table = $('.datatable-slotBootcampConfirmations:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection