@extends('layouts.admin')
@section('content')
@can('asset_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.pemasukan.create") }}">
            Add Pemasukan
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        List Pemasukan
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Asset">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Tanggal Pemasukan
                        </th>
                        <th>
                            Jumlah Pemasukan
                        </th>
                        <th>
                            Keterangan
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemasukan as $key => $pemasukan)
                    <tr data-entry-id="{{ $pemasukan->id }}">
                        <td>
                            {{ $pemasukan->id ?? '' }}
                        </td>
                        <td>
                            {{ $pemasukan->updated_at?? '' }}
                        </td>
                        <td>
                            {{ $pemasukan->nominal ?? '' }}
                        </td>
                        <td>
                            {{ $pemasukan->keterangan ?? '' }}
                        </td>
                        <td>
                            @can('pemasukan_show')
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.pemasukan.show', $pemasukan->id) }}">
                                View
                            </a>
                            @endcan
                            @can('pemasukan_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.pemasukan.edit', $pemasukan->id) }}">
                                Edit
                            </a>
                            @endcan
                            @can('pemasukan_delete')
                            <form action="{{ route('admin.pemasukan.destroy', $pemasukan->id) }}" method="POST"
                                onsubmit="return confirm('Anda Yakin Menghapus Data?');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="Delete">
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
@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('pemasukan_delete')
        let deleteButtonTrans = '{{ trans('
        global.datatables.delete ') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.pemasukan.massDestroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function (entry) {
                    return $(entry).data('entry-id')
                });
                if (ids.length === 0) {
                    alert('{{ trans('
                        global.datatables.zero_selected ') }}')
                    return
                }
                if (confirm('{{ trans('
                        global.areYouSure ') }}')) {
                    $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            },
                            method: 'POST',
                            url: config.url,
                            data: {
                                ids: ids,
                                _method: 'DELETE'
                            }
                        })
                        .done(function () {
                            location.reload()
                        })
                }
            }
        }
        dtButtons.push(deleteButton)
        @endcan
        $.extend(true, $.fn.dataTable.defaults, {
            order: [
                [1, 'desc']
            ],
            pageLength: 100,
        });
        $('.datatable-Asset:not(.ajaxTable)').DataTable({
            buttons: dtButtons
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })

</script>
@endsection
