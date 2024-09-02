@extends('layouts.admin')

@section('content')
    @if(session()->has('Status'))
        <div class="alert alert-success" role="alert">
            {{session()->get('Status')}}
        </div>
    @endif
    @if(session()->has('Failed'))
        <div class="alert alert-danger" role="alert">
            {{session()->get('Failed')}}
        </div>
    @endif
@can('bootcamp_attendee_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.bootcamp-attendees.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bootcampAttendee.title_singular') }}
            </a>
            <button class="btn btn-dark" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            <button class="btn btn-warning scan-Qrcode">
                Scan
            </button>

            @include('csvImport.modal', ['model' => 'BootcampAttendee', 'route' => 'admin.bootcamp-attendees.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.bootcampAttendee.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-BootcampAttendee">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.bootcampAttendee.fields.id') }}
                    </th>
{{--                    <th>--}}
{{--                        {{ trans('cruds.bootcampAttendee.fields.bootcamp_details') }}--}}
{{--                    </th>--}}
                    <th>
{{--                        {{ trans('cruds.bootcampAttendee.fields.bootcamp_participant') }}--}}
                        {{ "Participant" }}
                    </th>
                    <th>
                        {{"Workshop"}}
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
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    {{--Participant Column--}}
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    {{--Workshop Column--}}
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($workshops as $workshop)
                                <option value="{{ $workshop->title }}">{{ $workshop->title }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\BootcampAttendee::CATEGORY_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\BootcampAttendee::ATTENDANCE_STATUS_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
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

    {{--Qr Scanner --}}
    <div class="container mx-auto qrcode-container hide-scanner">
        <p class="close-scanning">x</p>
        <div id="qr-reader"></div>
        <div id="qr-reader-results"></div>
    </div>

    {{--End Qr Scanner --}}

@endsection
@section('scripts')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="{{asset('js/scanner.js')}}"></script>
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('bootcamp_attendee_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bootcamp-attendees.massDestroy') }}",
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
                    return entry.id
                });
                console.log(ids)
                // var new_ids = $('tr.selected').map(function(){
                //     return $(this).children(':nth-child(2)').html(); // Get the text of each selected div
                // }).get();

                // console.log(new_ids);
                console.log(ids);
                if (ids.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected') }}');
                    return;
                }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                    $.ajax({
                        headers: {'x-csrf-token': _token},
                        method: 'POST',
                        url: "{{ route('admin.bootcamp-attendees.generate.email') }}",
                        data: { ids: ids, _method: 'POST' }
                    })
                        .done(function (data) {
                            console.log(data)
                            location.reload();
                        });
                }
            }
        };

        dtButtons.push(EmailButton);

        {{-- End Email Button --}}
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.bootcamp-attendees.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'bootcamp_participant_name_en', name: 'bootcamp_participant.name_en' },
{ data: 'workshop_title', name: 'workshop_title' },
{ data: 'category', name: 'category' },
{ data: 'attendance_status', name: 'attendance_status' },
{ data: 'check_in_time', name: 'check_in_time' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-BootcampAttendee').DataTable(dtOverrideGlobals);
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
