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
@can('bootcamp_participant_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.bootcamp-participants.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bootcampParticipant.title_singular') }}
            </a>
            <a class="btn btn-info" href="{{ route('admin.bootcamp-participants.get.media') }}">
                Show Participants Media
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'BootcampParticipant', 'route' => 'admin.bootcamp-participants.parseCsvImport'])

        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.bootcampParticipant.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-BootcampParticipant">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.id') }}
                    </th>
                    <th>
                        Ticket ID
                    </th>

                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.name_en') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.name_ar') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.age') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.phone_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.educational_level') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.field_of_study') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.educational_institute') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.graduation_year') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.position') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.national') }}
                    </th>

                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.is_participated') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.participated_year') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.is_attend_formation_activity') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.first_priority') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.second_priority') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.third_priority') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.why_this_workshop') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.is_have_team') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.comment') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.year') }}
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
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($education_levels as $key => $item)
                                <option value="{{ $item->title }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($mention_your_fields as $key => $item)
                                <option value="{{ $item->title }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
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
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\BootcampParticipant::IS_PARTICIPATED_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\BootcampParticipant::IS_ATTEND_FORMATION_ACTIVITY_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($workshops as $key => $item)
                                <option value="{{ $item->title }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($workshops as $key => $item)
                                <option value="{{ $item->title }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($workshops as $key => $item)
                                <option value="{{ $item->title }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\BootcampParticipant::IS_HAVE_TEAM_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
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
@can('bootcamp_participant_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bootcamp-participants.massDestroy') }}",
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
                    return entry.national
                });

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
                        url: "{{ route('admin.bootcamp-attendees.generate.email') }}",
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

        {{-- End Email Button --}}
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.bootcamp-participants.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'uuid', name: 'uuid' },
{ data: 'name_en', name: 'name_en' },
{ data: 'name_ar', name: 'name_ar' },
{ data: 'email', name: 'email' },
{ data: 'age', name: 'age' },
{ data: 'phone_number', name: 'phone_number' },
{ data: 'educational_level_title', name: 'educational_level.title' },
{ data: 'field_of_study_title', name: 'field_of_study.title' },
{ data: 'educational_institute', name: 'educational_institute' },
{ data: 'graduation_year', name: 'graduation_year' },
{ data: 'position', name: 'position' },
{ data: 'national', name: 'national' },
{ data: 'is_participated', name: 'is_participated' },
{ data: 'participated_year', name: 'participated_year' },
{ data: 'is_attend_formation_activity', name: 'is_attend_formation_activity' },
{ data: 'first_priority_title', name: 'first_priority.title' },
{ data: 'second_priority_title', name: 'second_priority.title' },
{ data: 'third_priority_title', name: 'third_priority.title' },
{ data: 'why_this_workshop', name: 'why_this_workshop' },
{ data: 'is_have_team', name: 'is_have_team' },
{ data: 'comment', name: 'comment' },
{ data: 'year', name: 'year' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 10, 'asc' ]],

    pageLength: 100,
  };
  let table = $('.datatable-BootcampParticipant').DataTable(dtOverrideGlobals);
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
