@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Detail Pengeluaran
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pengeluaran.index') }}">
                    Back
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            ID
                        </th>
                        <td>
                            {{ $pengeluaran->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Tanggal Pengeluaran
                        </th>
                        <td>
                            {{ $pengeluaran->updated_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Jumlah Pengeluaran
                        </th>
                        <td>
                            {{ $pengeluaran->nominal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Keterangan
                        </th>
                        <td>
                            {{ $pengeluaran->keterangan }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
