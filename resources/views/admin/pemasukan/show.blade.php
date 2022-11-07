@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Detail Pemasukan
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pemasukan.index') }}">
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
                            {{ $pemasukan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Tanggal Pemasukan
                        </th>
                        <td>
                            {{ $pemasukan->updated_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Jumlah Pemasukan
                        </th>
                        <td>
                            {{ $pemasukan->nominal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Keterangan
                        </th>
                        <td>
                            {{ $pemasukan->keterangan }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
