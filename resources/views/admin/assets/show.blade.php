@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Show Bahan
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.assets.index') }}">
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
                            {{ $asset->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nama Bahan
                        </th>
                        <td>
                            {{ $asset->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Deskripsi
                        </th>
                        <td>
                            {{ $asset->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Prioritas Bahan
                        </th>
                        <td>
                            {{ $asset->danger_level }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
