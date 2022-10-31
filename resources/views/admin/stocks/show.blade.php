@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Show Stok
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.stocks.index') }}">
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
                            {{ $stock->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nama Bahan
                        </th>
                        <td>
                            {{ $stock->asset->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Stok Saat Ini
                        </th>
                        <td>
                            {{ $stock->current_stock }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <h4 class="text-center">
                Riwayat Stok {{ $stock->asset->name }}
                @if(count($stock->asset->transactions) == 0)
                is empty
                @endif
            </h4>
            @if(count($stock->asset->transactions) > 0)
            <table class="table table-sm table-bordered table-striped col-6 m-auto">
                <thead>
                    <tr>
                        <th class="w-75">User</th>
                        <th>Jumlah</th>
                    </tr>
                    @foreach($stock->asset->transactions as $transaction)
                    <tr>
                        <td>
                            {{ $transaction->user->name }}
                            ({{ $transaction->user->email }})
                            ({{ $transaction->user->team->name }})
                        </td>
                        <td>{{ $transaction->stock }}</td>
                    </tr>
                    @endforeach
                </thead>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection
