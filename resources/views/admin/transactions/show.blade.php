@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Show Riwayat Pemakaian Bahan
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transactions.index') }}">
                    Back to List
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            ID
                        </th>
                        <td>
                            {{ $transaction->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nama Bahan
                        </th>
                        <td>
                            {{ $transaction->asset->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            User
                        </th>
                        <td>
                            {{ $transaction->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Stok
                        </th>
                        <td>
                            {{ $transaction->stock }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
