@extends('layouts.admin')
@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{session()->get('success')}}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            {{ 'Onsite Accepted ' . trans('cruds.team.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.teams.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Team">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.team.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.uuid') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.team_leader') }}
                    </th>
                    <th>
                        {{ trans('cruds.member.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.team_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.challenge') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.actual_solution') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.mentorship_needed') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.participation_method') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.limited_capacity') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.members_participated_before') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.project_proposal_url') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.project_video_url') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.team_rating') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.total_score') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.submission_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.team.fields.extra_field') }}
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
                            @foreach($members as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($challenges as $key => $item)
                                <option value="{{ $item->title }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($actual_solutions as $key => $item)
                                <option value="{{ $item->title }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($mentorship_neededs as $key => $item)
                                <option value="{{ $item->title }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($participation_methods as $key => $item)
                                <option value="{{ $item->title }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
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
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Team::STATUS_SELECT as $key => $item)
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
            @can('team_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.teams.massDestroy') }}",
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
            {{-- Start Email Button --}}
            let EmailButtonTrans = 'Send Email';
            let EmailButton = {
                text: EmailButtonTrans,
                className: 'btn-dark',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                        return entry.id
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
                            url: "{{ route('admin.teams.generateAndEmail') }}",
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
            @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.teams.showOnsite') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'uuid', name: 'uuid' },
                    { data: 'team_leader_name', name: 'team_leader.name' },
                    { data: 'team_leader.email', name: 'team_leader.email' },
                    { data: 'team_name', name: 'team_name' },
                    { data: 'challenge_title', name: 'challenge.title' },
                    { data: 'actual_solution_title', name: 'actual_solution.title' },
                    { data: 'mentorship_needed_title', name: 'mentorship_needed.title' },
                    { data: 'participation_method_title', name: 'participation_method.title' },
                    { data: 'limited_capacity', name: 'limited_capacity' },
                    { data: 'members_participated_before', name: 'members_participated_before' },
                    { data: 'project_proposal_url', name: 'project_proposal_url' },
                    { data: 'project_video_url', name: 'project_video_url' },
                    { data: 'team_rating', name: 'team_rating' },
                    { data: 'total_score', name: 'total_score' },
                    { data: 'status', name: 'status' },
                    { data: 'submission_date', name: 'submission_date' },
                    { data: 'extra_field', name: 'extra_field' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            };
            let table = $('.datatable-Team').DataTable(dtOverrideGlobals);
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
            const script = document.createElement('script');
script.src = "{{ asset('js/rangeSelection.js') }}";
script.defer = true; // Use defer to ensure it runs after parsing the document

// Add a load event listener to execute your code after the script is loaded
script.onload = function () {
    // Your button-related code here
    const buttonsConatiner = document.querySelector(".dt-buttons");
    console.log(buttonsConatiner);

    const html = `
        <a class="btn select-range-button btn-primary">
            <span>Select</span>
        </a>
        <a class="btn deselect-range-button btn-primary disabled">
            <span>Deselect</span>
        </a>
        <input type="number" name="from" id="fromField" placeholder="From" min="1" />
        <input type="number" name="To" id="toField" placeholder="To" min="1" />
    `;
    buttonsConatiner.insertAdjacentHTML("beforeend", html);

    // Select Elements
    const fromInput = document.querySelector("#fromField");
    const toInput = document.querySelector("#toField");
    const selectBtn = document.querySelector(".select-range-button");
    const deselectBtn = document.querySelector(".deselect-range-button");

    selectBtn.addEventListener('click', function (e) {
        e.preventDefault();
        handleRangeSelction('select');
    });
    deselectBtn.addEventListener('click', function (e) {
        e.preventDefault();
        handleRangeSelction('deselect');
    });

    function handleRangeSelction(action) {
        console.log("Clicked");
        const rows = document.querySelectorAll(".row");
        const size = rows.length;
        const start = parseInt(fromInput.value, 10);
        const end = parseInt(toInput.value, 10);

        console.log(rows);
        console.log(size, start, end);

        const isValid = rangeValidation(start, end, size);
        if (isValid) {
            for (let i = start - 1; i < end; i++) {
                const el = rows[i];
                if (action === 'select') {
                    el.classList.add('selected');
                } else {
                    el.classList.remove('selected');
                }
            }
        } else {
            alert("Enter A Valid Range");
        }
    }

    function rangeValidation(start, end, size) {
        return start <= end && start > 0 && end <= size;
    }
};

document.body.appendChild(script);
        });


    </script>

@endsection
