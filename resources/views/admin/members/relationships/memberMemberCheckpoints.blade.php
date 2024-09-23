@can('member_checkpoint_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.member-checkpoints.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.memberCheckpoint.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.memberCheckpoint.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-memberMemberCheckpoints">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.memberCheckpoint.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.memberCheckpoint.fields.member') }}
                        </th>
                        <th>
                            {{ trans('cruds.memberCheckpoint.fields.checkpoint') }}
                        </th>
                        <th>
                            {{ trans('cruds.memberCheckpoint.fields.completed') }}
                        </th>
                        <th>
                            {{ trans('cruds.memberCheckpoint.fields.completion_time') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($memberCheckpoints as $key => $memberCheckpoint)
                        <tr data-entry-id="{{ $memberCheckpoint->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $memberCheckpoint->id ?? '' }}
                            </td>
                            <td>
                                {{ $memberCheckpoint->member->name ?? '' }}
                            </td>
                            <td>
                                {{ $memberCheckpoint->checkpoint->name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $memberCheckpoint->completed ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $memberCheckpoint->completed ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $memberCheckpoint->completion_time ?? '' }}
                            </td>
                            <td>
                                @can('member_checkpoint_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.member-checkpoints.show', $memberCheckpoint->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('member_checkpoint_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.member-checkpoints.edit', $memberCheckpoint->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('member_checkpoint_delete')
                                    <form action="{{ route('admin.member-checkpoints.destroy', $memberCheckpoint->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('member_checkpoint_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.member-checkpoints.massDestroy') }}",
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
  let table = $('.datatable-memberMemberCheckpoints:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection