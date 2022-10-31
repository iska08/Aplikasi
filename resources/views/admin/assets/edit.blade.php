@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Edit Bahan
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("admin.assets.update", [$asset->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">Nama Bahan</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                    id="name" value="{{ old('name', $asset->name) }}" required>
                @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                    id="description">{{ old('description', $asset->description) }}</textarea>
                @if($errors->has('description'))
                <div class="invalid-feedback">
                    {{ $errors->first('description') }}
                </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="required" for="danger_level">Prioritas Bahan</label>
                <input class="form-control {{ $errors->has('danger_level') ? 'is-invalid' : '' }}" type="number"
                    name="danger_level" id="danger_level" value="{{ old('danger_level', $asset->danger_level) }}"
                    required min="1">
                @if($errors->has('danger_level'))
                <div class="invalid-feedback">
                    {{ $errors->first('danger_level') }}
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
