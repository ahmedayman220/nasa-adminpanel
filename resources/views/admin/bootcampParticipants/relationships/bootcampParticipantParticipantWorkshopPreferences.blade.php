@can('participant_workshop_preference_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.participant-workshop-preferences.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.participantWorkshopPreference.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.participantWorkshopPreference.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-bootcampParticipantParticipantWorkshopPreferences">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.participantWorkshopPreference.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.participantWorkshopPreference.fields.bootcamp_participant') }}
                        </th>
                        <th>
                            {{ trans('cruds.participantWorkshopPreference.fields.workshop') }}
                        </th>
                        <th>
                            {{ trans('cruds.participantWorkshopPreference.fields.preference_order') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($participantWorkshopPreferences as $key => $participantWorkshopPreference)
                        <tr data-entry-id="{{ $participantWorkshopPreference->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $participantWorkshopPreference->id ?? '' }}
                            </td>
                            <td>
                                {{ $participantWorkshopPreference->bootcamp_participant->name_en ?? '' }}
                            </td>
                            <td>
                                {{ $participantWorkshopPreference->workshop->title ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\ParticipantWorkshopPreference::PREFERENCE_ORDER_SELECT[$participantWorkshopPreference->preference_order] ?? '' }}
                            </td>
                            <td>
                                @can('participant_workshop_preference_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.participant-workshop-preferences.show', $participantWorkshopPreference->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('participant_workshop_preference_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.participant-workshop-preferences.edit', $participantWorkshopPreference->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('participant_workshop_preference_delete')
                                    <form action="{{ route('admin.participant-workshop-preferences.destroy', $participantWorkshopPreference->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('participant_workshop_preference_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.participant-workshop-preferences.massDestroy') }}",
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
  let table = $('.datatable-bootcampParticipantParticipantWorkshopPreferences:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection