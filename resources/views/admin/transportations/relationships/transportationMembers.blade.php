@can('member_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.members.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.member.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.member.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-transportationMembers">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.member.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.uuid') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.national') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.phone_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.age') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.nationa_id_photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.is_new') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.major') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.organization') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.participant_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.study_level') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.tshirt_size') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.qr_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.member_role') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.extra_field') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.transportation') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $key => $member)
                        <tr data-entry-id="{{ $member->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $member->id ?? '' }}
                            </td>
                            <td>
                                {{ $member->uuid ?? '' }}
                            </td>
                            <td>
                                {{ $member->national ?? '' }}
                            </td>
                            <td>
                                {{ $member->name ?? '' }}
                            </td>
                            <td>
                                {{ $member->email ?? '' }}
                            </td>
                            <td>
                                {{ $member->phone_number ?? '' }}
                            </td>
                            <td>
                                {{ $member->age ?? '' }}
                            </td>
                            <td>
                                @if($member->nationa_id_photo)
                                    <a href="{{ $member->nationa_id_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $member->nationa_id_photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                <span style="display:none">{{ $member->is_new ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $member->is_new ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $member->major->title ?? '' }}
                            </td>
                            <td>
                                {{ $member->organization ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Member::PARTICIPANT_TYPE_SELECT[$member->participant_type] ?? '' }}
                            </td>
                            <td>
                                {{ $member->study_level->title ?? '' }}
                            </td>
                            <td>
                                {{ $member->tshirt_size->title ?? '' }}
                            </td>
                            <td>
                                {{ $member->qr_code->qr_code_value ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Member::MEMBER_ROLE_SELECT[$member->member_role] ?? '' }}
                            </td>
                            <td>
                                {{ $member->extra_field ?? '' }}
                            </td>
                            <td>
                                {{ $member->transportation->title ?? '' }}
                            </td>
                            <td>
                                @can('member_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.members.show', $member->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('member_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.members.edit', $member->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('member_delete')
                                    <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('member_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.members.massDestroy') }}",
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
  let table = $('.datatable-transportationMembers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection