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

    @can('bootcamp_confirmation_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.bootcamp-confirmations.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.bootcampConfirmation.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'BootcampConfirmation', 'route' => 'admin.bootcamp-confirmations.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.bootcampConfirmation.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-BootcampConfirmation">
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
                        {{ trans('cruds.bootcampConfirmation.fields.phone_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampConfirmation.fields.slot') }}
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
                            @foreach($bootcamp_participants as $key => $item)
                                <option value="{{ $item->name_en }}">{{ $item->name_en }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($study_levels as $key => $item)
                                <option value="{{ $item->title }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
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
            @can('bootcamp_confirmation_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.bootcamp-confirmations.massDestroy') }}",
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
                    console.log(ids)

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



            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.bootcamp-confirmations.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'national', name: 'national.name_en' },
                    { data: 'phone_number', name: 'phone_number' },
                    { data: 'slot_title', name: 'slot.title' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            };
            let table = $('.datatable-BootcampConfirmation').DataTable(dtOverrideGlobals);
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
