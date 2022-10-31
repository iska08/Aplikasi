@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Create Riwayat Pemakaian Bahan
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transactions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="asset_id">ID Bahan</label>
                <select class="form-control select2 {{ $errors->has('asset') ? 'is-invalid' : '' }}" name="asset_id"
                    id="asset_id" required>
                    @foreach($assets as $id => $asset)
                    <option value="{{ $id }}" {{ old('asset_id') == $id ? 'selected' : '' }}>{{ $asset }}</option>
                    @endforeach
                </select>
                @if($errors->has('asset'))
                <div class="invalid-feedback">
                    {{ $errors->first('asset') }}
                </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">ID User</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id"
                    id="user_id" required>
                    @foreach($users as $id => $user)
                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                <div class="invalid-feedback">
                    {{ $errors->first('user') }}
                </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="required" for="stock">Stok</label>
                <input class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}" type="number" name="stock"
                    id="stock" value="{{ old('stock', '') }}" step="1" required>
                @if($errors->has('stock'))
                <div class="invalid-feedback">
                    {{ $errors->first('stock') }}
                </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
