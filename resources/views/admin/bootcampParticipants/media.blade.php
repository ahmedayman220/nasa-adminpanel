@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.bootcampParticipant.title') }} Media
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-BootcampParticipant">
                <thead>
                <tr>
                    <th>

                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.name_en') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.name_ar') }}
                    </th>
                    <th>
                        {{ trans('cruds.bootcampParticipant.fields.national') }}
                    </th>
                    <th>
                        {{ 'National Front' }}
                    </th>
                    <th>
                        {{ 'National Back' }}
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
{{--    script here --}}
    <script>
        $(document).ready(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        let dtOverrideGlobals = {
            buttons: dtButtons,
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: "{{ route('admin.bootcamp-participants.get.media') }}",
            columns: [
                { data: 'placeholder', name: 'placeholder' },
                { data: 'id', name: 'id' },
                { data: 'name_en', name: 'name_en' },
                { data: 'name_ar', name: 'name_ar' },
                { data: 'national', name: 'national' },
                { data: 'national_id_front', name: 'national_id_front' },
                { data: 'national_id_back', name: 'national_id_back' },
            ],
            orderCellsTop: true,
            order: [[ 1, 'asc' ]],
            pageLength: 50,
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
