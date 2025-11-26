@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')
<div class="page-header">
    <h2>Edit Kategori: {{ $category->name }}</h2>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="form-container">
    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Nama Kategori <span class="required">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required>
            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="4">{{ old('description', $category->description) }}</textarea>
            <small>Opsional - Jelaskan kategori ini</small>
            @error('description')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Kategori</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection