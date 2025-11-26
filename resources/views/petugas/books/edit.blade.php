{{-- resources/views/petugas/books/edit.blade.php --}}
@extends('layouts.petugas')

@section('title', 'Edit Buku')
@section('page-title', 'Edit Buku')

@section('content')
<div class="page-header">
    <h2>Edit Buku: {{ $book->title }}</h2>
    <a href="{{ route('petugas.books.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="form-container">
    <form method="POST" action="{{ route('petugas.books.update', $book->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">Judul Buku <span class="required">*</span></label>
            <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" required>
            @error('title')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="author">Pengarang <span class="required">*</span></label>
            <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" required>
            @error('author')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="publisher">Penerbit <span class="required">*</span></label>
            <input type="text" name="publisher" id="publisher" value="{{ old('publisher', $book->publisher) }}" required>
            @error('publisher')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="isbn">ISBN <span class="required">*</span></label>
                <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}" required>
                @error('isbn')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="year">Tahun Terbit <span class="required">*</span></label>
                <input type="number" name="year" id="year" value="{{ old('year', $book->year) }}" min="1900" max="{{ date('Y') }}" required>
                @error('year')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="shelf_code">Kode Rak <span class="required">*</span></label>
            <input type="text" name="shelf_code" id="shelf_code" value="{{ old('shelf_code', $book->shelf_code) }}" placeholder="Contoh: A-01, B-12" required>
            <small>Kode lokasi rak penyimpanan buku</small>
            @error('shelf_code')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_id">Kategori <span class="required">*</span></label>
            <select name="category_id" id="category_id" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="stock">Jumlah Stok <span class="required">*</span></label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $book->stock) }}" min="0" required>
            @error('stock')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="5">{{ old('description', $book->description) }}</textarea>
            @error('description')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="cover">Cover Buku</label>
            @if($book->cover)
                <div>
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" style="max-width: 200px; margin-bottom: 10px;">
                    <p>Cover saat ini</p>
                </div>
            @endif
            <input type="file" name="cover" id="cover" accept="image/*">
            <small>Format: JPG, PNG, JPEG (Max: 2MB) - Kosongkan jika tidak ingin mengubah</small>
            @error('cover')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="pages">Jumlah Halaman</label>
            <input type="number" name="pages" id="pages" value="{{ old('pages', $book->pages) }}" min="1">
            @error('pages')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="language">Bahasa</label>
            <input type="text" name="language" id="language" value="{{ old('language', $book->language) }}">
            @error('language')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Buku</button>
            <a href="{{ route('petugas.books.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection