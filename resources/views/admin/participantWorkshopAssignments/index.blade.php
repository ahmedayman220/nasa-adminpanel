@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/scanner.css')}}" />
@endsection
@section('content')
    @if(session()->has('Success'))
        <div class="alert alert-success" role="alert">
            {{session()->get('Success')}}
        </div>
    @endif
    @if(session()->has('Failed'))
        <div class="alert alert-danger" role="alert">
            {{session()->get('Failed')}}
        </div>
    @endif
@can('participant_workshop_assignment_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.participant-workshop-assignments.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.participantWorkshopAssignment.title_singular') }}
            </a>
            <button class="btn btn-dark" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            <button class="btn btn-warning scan-Qrcode" data-toggle="modal">
                Scan Qr Code
            </button>
            @include('csvImport.modal', ['model' => 'ParticipantWorkshopAssignment', 'route' => 'admin.participant-workshop-assignments.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.participantWorkshopAssignment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ParticipantWorkshopAssignment">
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
                    <th>{{ trans('cruds.workshopSchedule.fields.workshop') }}</th> <!-- Add Workshop column -->
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
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($bootcamp_participants as $key => $item)
                                <option value="{{ $item->name_en }}">{{ $item->name_en }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($workshop_schedules as $item)
                                <option value="{{ $item->workshop->title }}">{{ $item->workshop->title }}</option> <!-- Filtering based on workshop title -->
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($workshop_schedules as $key => $item)
                                <option value="{{ $item->schedule_time }}">{{ $item->workshop->title . ' ' . $item->schedule_time }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\ParticipantWorkshopAssignment::ATTENDANCE_STATUS_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
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
    <script src="{{asset('js/scanner2.js')}}"></script>
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('participant_workshop_assignment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.participant-workshop-assignments.massDestroy') }}",
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.participant-workshop-assignments.index') }}",
    columns: [
{ data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'bootcamp_participant_name_en', name: 'bootcamp_participant.name_en' },
{ data: 'workshop_title', name: 'workshop_schedule.workshop.title' },  // New workshop column
{ data: 'workshop_schedule_schedule_time', name: 'workshop_schedule.schedule_time' },
{ data: 'attendance_status', name: 'attendance_status' },
{ data: 'check_in_time', name: 'check_in_time' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ParticipantWorkshopAssignment').DataTable(dtOverrideGlobals);
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
