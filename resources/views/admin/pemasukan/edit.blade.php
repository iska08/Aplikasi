@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Edit Detail Pemasukan
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("admin.pemasukan.update", [$pemasukan->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nominal">Jumlah Pemasukan</label>
                <input class="form-control {{ $errors->has('nominal') ? 'is-invalid' : '' }}" type="number" name="nominal"
                    id="nominal" value="{{ old('nominal', '') }}" required>
                @if($errors->has('nominal'))
                <div class="invalid-feedback">
                    {{ $errors->first('nominal') }}
                </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" name="keterangan"
                    id="keterangan">{{ old('keterangan') }}</textarea>
                @if($errors->has('keterangan'))
                <div class="invalid-feedback">
                    {{ $errors->first('keterangan') }}
                </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    Save
                </button>
                <a href="{{ route('admin.pemasukan.index') }}" class="btn btn-danger">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
