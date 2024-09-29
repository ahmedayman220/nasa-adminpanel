@can('user_challenge_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.user-challenges.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.userChallenge.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.userChallenge.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userUserChallenges">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.userChallenge.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.userChallenge.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.userChallenge.fields.challenge') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($userChallenges as $key => $userChallenge)
                    <tr data-entry-id="{{ $userChallenge->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $userChallenge->id ?? '' }}
                        </td>
                        <td>
                            @foreach($userChallenge->users as $key => $item)
                                <span class="badge badge-info">{{ $item->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            @foreach($userChallenge->challenges as $key => $item)
                                <span class="badge badge-info">{{ $item->title }}</span>
                            @endforeach
                        </td>
                        <td>
                            @can('user_challenge_show')
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.user-challenges.show', $userChallenge->id) }}">
                                    {{ trans('global.view') }}
                                </a>
                            @endcan

                            @can('user_challenge_edit')
                                <a class="btn btn-xs btn-info" href="{{ route('admin.user-challenges.edit', $userChallenge->id) }}">
                                    {{ trans('global.edit') }}
                                </a>
                            @endcan

                            @can('user_challenge_delete')
                                <form action="{{ route('admin.user-challenges.destroy', $userChallenge->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            @can('user_challenge_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.user-challenges.massDestroy') }}",
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
            let table = $('.datatable-userUserChallenges:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
