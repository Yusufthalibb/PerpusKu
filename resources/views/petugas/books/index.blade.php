@extends('layouts.petugas')

@section('title', 'Kelola Buku')
@section('page-title', 'Kelola Buku')

@section('content')
<div class="page-header">
    <h2>Daftar Buku</h2>
    <div class="page-actions">
        <a href="{{ route('petugas.books.create') }}" class="btn btn-primary">+ Tambah Buku</a>
    </div>
</div>

<!-- Filter & Search -->
<div class="filter-section">
    <form method="GET" action="{{ route('petugas.books.index') }}">
        <div class="filter-group">
            <input type="text" name="search" placeholder="Cari judul atau pengarang..." value="{{ request('search') }}">
            
            <select name="category">
                <option value="">Semua Kategori</option>
                @foreach($categories ?? [] as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <select name="status">
                <option value="">Semua Status</option>
                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
            </select>
            
            <button type="submit" class="btn btn-secondary">Filter</button>
            <a href="{{ route('petugas.books.index') }}" class="btn btn-link">Reset</a>
        </div>
    </form>
</div>

<!-- Books Table -->
<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cover</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Kategori</th>
                <th>ISBN</th>
                <th>Stok</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>
                    @if($book->image && file_exists(public_path('storage/' . $book->image)))
    <img src="{{ asset('storage/' . $book->image) }}" width="150">
@else
    <img src="{{ asset('default-book.png') }}" width="150">
@endif

                </td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->category->name ?? '-' }}</td>
                <td>{{ $book->isbn }}</td>
                <td>{{ $book->stock }}</td>
                <td>
                    <span class="badge badge-{{ $book->stock > 0 ? 'available' : 'borrowed' }}">
                        {{ $book->stock > 0 ? 'Tersedia' : 'Habis' }}
                    </span>
                </td>
                <td class="action-buttons">
                    <a href="{{ route('petugas.books.show', $book->id) }}" class="btn btn-sm btn-info">Lihat</a>
                    <a href="{{ route('petugas.books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form method="POST" action="{{ route('petugas.books.destroy', $book->id) }}" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align: center;">Tidak ada data buku</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="pagination-container">
    {{ $books->links() }}
</div>
@endsection