{{-- resources/views/petugas/categories/index.blade.php --}}
@extends('layouts.petugas')

@section('title', 'Kelola Kategori')
@section('page-title', 'Kelola Kategori')

@section('content')
<div class="page-header">
    <h2>Daftar Kategori</h2>
    <div class="page-actions">
        <a href="{{ route('petugas.categories.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
    </div>
</div>

<div class="filter-section">
    <form method="GET" action="{{ route('petugas.categories.index') }}">
        <div class="filter-group">
            <input type="text" name="search" placeholder="Cari kategori..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary">Cari</button>
            <a href="{{ route('petugas.categories.index') }}" class="btn btn-link">Reset</a>
        </div>
    </form>
</div>

<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Jumlah Buku</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description ?? '-' }}</td>
                <td>{{ $category->books_count ?? 0 }} buku</td>
                <td class="action-buttons">
                    <a href="{{ route('petugas.categories.show', $category->id) }}" class="btn btn-sm btn-info">Lihat</a>
                    <a href="{{ route('petugas.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form method="POST" action="{{ route('petugas.categories.destroy', $category->id) }}" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">Tidak ada data kategori</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-container">
    {{ $categories->links() }}
</div>
@endsection


{{-- resources/views/petugas/categories/create.blade.php --}}
@extends('layouts.petugas')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')

@section('content')
<div class="page-header">
    <h2>Tambah Kategori Baru</h2>
    <a href="{{ route('petugas.categories.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="form-container">
    <form method="POST" action="{{ route('petugas.categories.store') }}">
        @csrf
        
        <div class="form-group">
            <label for="name">Nama Kategori <span class="required">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>
            @error('description')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Simpan Kategori</button>
            <a href="{{ route('petugas.categories.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection


{{-- resources/views/petugas/categories/edit.blade.php --}}
@extends('layouts.petugas')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')
<div class="page-header">
    <h2>Edit Kategori: {{ $category->name }}</h2>
    <a href="{{ route('petugas.categories.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="form-container">
    <form method="POST" action="{{ route('petugas.categories.update', $category->id) }}">
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
            @error('description')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Kategori</button>
            <a href="{{ route('petugas.categories.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection


{{-- resources/views/petugas/categories/show.blade.php --}}
@extends('layouts.petugas')

@section('title', 'Detail Kategori')
@section('page-title', 'Detail Kategori')

@section('content')
<div class="page-header">
    <h2>Detail Kategori</h2>
    <div class="page-actions">
        <a href="{{ route('petugas.categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('petugas.categories.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>
</div>

<div class="detail-container">
    <div class="detail-card">
        <h3>Informasi Kategori</h3>
        <table class="detail-table">
            <tr>
                <th>ID</th>
                <td>{{ $category->id }}</td>
            </tr>
            <tr>
                <th>Nama Kategori</th>
                <td>{{ $category->name }}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{{ $category->description ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jumlah Buku</th>
                <td>{{ $category->books->count() }} buku</td>
            </tr>
        </table>
    </div>

    <div class="detail-card">
        <h3>Daftar Buku dalam Kategori Ini</h3>
        @if($category->books && $category->books->count() > 0)
        <table class="data-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category->books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->stock }}</td>
                    <td>
                        <a href="{{ route('petugas.books.show', $book->id) }}" class="btn btn-sm btn-info">Lihat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Belum ada buku dalam kategori ini</p>
        @endif
    </div>
</div>
@endsection