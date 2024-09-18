@extends('layouts.admin')
@section('content')
@can('bootcamp_form_description_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.bootcamp-form-descriptions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bootcampFormDescription.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'BootcampFormDescription', 'route' => 'admin.bootcamp-form-descriptions.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.bootcampFormDescription.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-BootcampFormDescription">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.bootcampFormDescription.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampFormDescription.fields.section_1_title') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampFormDescription.fields.national_id_front_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampFormDescription.fields.national_id_back_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampFormDescription.fields.section_2_title') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('bootcamp_form_description_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bootcamp-form-descriptions.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

        {{-- Start Email Button --}}
        let EmailButtonTrans = 'Send Email';
        let EmailButton = {
            text: EmailButtonTrans,
            className: 'btn-dark',
            action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                    return entry.section_2_title
                });
                console.log(ids);

                // var new_ids = $('tr.selected').map(function(){
                //     return $(this).children(':nth-child(2)').html(); // Get the text of each selected div
                // }).get();

                // console.log(new_ids);
                if (ids.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected') }}');
                    return;
                }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                    $.ajax({
                        headers: {'x-csrf-token': _token},
                        method: 'POST',
                        url: "{{ route('admin.bootcamp-attendees.generate.email.iu') }}",
                        data: { ids: ids, _method: 'POST' }
                    })
                        .done(function (data) {
                            // console.log(data)
                            location.reload();
                        });
                }
            }
        };

        dtButtons.push(EmailButton);

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.bootcamp-form-descriptions.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'section_1_title', name: 'section_1_title' },
{ data: 'national_id_front_description', name: 'national_id_front_description' },
{ data: 'national_id_back_description', name: 'national_id_back_description' },
{ data: 'section_2_title', name: 'section_2_title' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-BootcampFormDescription').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection
