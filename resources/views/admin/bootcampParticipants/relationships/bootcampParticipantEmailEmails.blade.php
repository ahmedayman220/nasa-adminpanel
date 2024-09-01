@can('email_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.emails.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.email.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.email.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-bootcampParticipantEmailEmails">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.email.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.email.fields.qrcode') }}
                        </th>
                        <th>
                            {{ trans('cruds.email.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.email.fields.bootcamp_participant_email') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($emails as $key => $email)
                        <tr data-entry-id="{{ $email->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $email->id ?? '' }}
                            </td>
                            <td>
                                {{ $email->qrcode->qr_code_value ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Email::STATUS_SELECT[$email->status] ?? '' }}
                            </td>
                            <td>
                                {{ $email->bootcamp_participant_email->email ?? '' }}
                            </td>
                            <td>
                                @can('email_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.emails.show', $email->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('email_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.emails.edit', $email->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('email_delete')
                                    <form action="{{ route('admin.emails.destroy', $email->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('email_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.emails.massDestroy') }}",
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
  let table = $('.datatable-bootcampParticipantEmailEmails:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection