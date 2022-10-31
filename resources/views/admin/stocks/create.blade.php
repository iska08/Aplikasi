@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Create Stok
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.stocks.store") }}" enctype="multipart/form-data">
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
                <label for="current_stock">Stok Saat Ini</label>
                <input class="form-control {{ $errors->has('current_stock') ? 'is-invalid' : '' }}" type="number"
                    name="current_stock" id="current_stock" value="{{ old('current_stock', '') }}" step="1">
                @if($errors->has('current_stock'))
                <div class="invalid-feedback">
                    {{ $errors->first('current_stock') }}
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
