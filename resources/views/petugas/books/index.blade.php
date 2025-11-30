@extends('layouts.petugas')

@section('title', 'Kelola Buku')
@section('page-title', 'Kelola Buku')

@section('content')
<style>
    :root {
        --primary-red: #DC2626;
        --primary-red-dark: #B91C1C;
        --primary-red-light: #FEE2E2;
        --secondary-red: #EF4444;
        --text-dark: #1F2937;
        --text-gray: #6B7280;
        --border-color: #E5E7EB;
        --bg-white: #FFFFFF;
        --bg-gray: #F9FAFB;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid var(--border-color);
    }

    .page-header h2 {
        font-size: 1.875rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
    }

    .page-actions {
        display: flex;
        gap: 0.75rem;
    }

    .filter-section {
        background: var(--bg-white);
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: var(--shadow-sm);
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .filter-group {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .filter-group input[type="text"],
    .filter-group select {
        padding: 0.625rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 0.9375rem;
        transition: all 0.3s ease;
        background: var(--bg-white);
    }

    .filter-group input[type="text"] {
        flex: 1;
        min-width: 250px;
    }

    .filter-group select {
        min-width: 180px;
    }

    .filter-group input[type="text"]:focus,
    .filter-group select:focus {
        outline: none;
        border-color: var(--primary-red);
        box-shadow: 0 0 0 3px var(--primary-red-light);
    }

    .btn {
        padding: 0.625rem 1.25rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9375rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-primary {
        background: var(--primary-red);
        color: white;
        box-shadow: var(--shadow-sm);
    }

    .btn-primary:hover {
        background: var(--primary-red-dark);
        box-shadow: var(--shadow-md);
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: var(--bg-white);
        color: var(--text-dark);
        border: 2px solid var(--border-color);
    }

    .btn-secondary:hover {
        background: var(--bg-gray);
        border-color: var(--text-gray);
    }

    .btn-link {
        background: transparent;
        color: var(--primary-red);
        padding: 0.625rem 1rem;
    }

    .btn-link:hover {
        background: var(--primary-red-light);
    }

    .btn-sm {
        padding: 0.375rem 0.875rem;
        font-size: 0.875rem;
    }

    .btn-info {
        background: #3B82F6;
        color: white;
    }

    .btn-info:hover {
        background: #2563EB;
    }

    .btn-warning {
        background: #F59E0B;
        color: white;
    }

    .btn-warning:hover {
        background: #D97706;
    }

    .btn-danger {
        background: var(--primary-red);
        color: white;
    }

    .btn-danger:hover {
        background: var(--primary-red-dark);
    }

    .table-container {
        background: var(--bg-white);
        border-radius: 12px;
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        border: 1px solid var(--border-color);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead {
        background: linear-gradient(135deg, var(--primary-red) 0%, var(--secondary-red) 100%);
    }

    .data-table thead th {
        padding: 1rem 1.25rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.875rem;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .data-table tbody tr {
        border-bottom: 1px solid var(--border-color);
        transition: all 0.2s ease;
    }

    .data-table tbody tr:hover {
        background: var(--primary-red-light);
    }

    .data-table tbody tr:last-child {
        border-bottom: none;
    }

    .data-table tbody td {
        padding: 1rem 1.25rem;
        color: var(--text-dark);
        font-size: 0.9375rem;
        vertical-align: middle;
    }

    .data-table tbody td img {
        border-radius: 8px;
        box-shadow: var(--shadow-sm);
        object-fit: cover;
        border: 2px solid var(--border-color);
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .action-buttons form {
        margin: 0;
    }

    .badge {
        padding: 0.375rem 0.875rem;
        border-radius: 9999px;
        font-size: 0.8125rem;
        font-weight: 600;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-available {
        background: #D1FAE5;
        color: #065F46;
        border: 1px solid #10B981;
    }

    .badge-borrowed {
        background: #FEE2E2;
        color: #991B1B;
        border: 1px solid var(--primary-red);
    }

    .pagination-container {
        margin-top: 1.5rem;
        display: flex;
        justify-content: center;
    }

    @media (max-width: 1024px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .filter-group {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-group input[type="text"],
        .filter-group select {
            width: 100%;
            min-width: 100%;
        }

        .table-container {
            overflow-x: auto;
        }

        .data-table {
            min-width: 900px;
        }

        .action-buttons {
            flex-direction: column;
            align-items: flex-start;
        }

        .action-buttons .btn {
            width: 100%;
        }
    }

    /* Empty State */
    .data-table tbody td[colspan] {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--text-gray);
        font-style: italic;
    }
</style>

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
                        <img src="{{ asset('storage/' . $book->image) }}" width="60" height="80">
                    @else
                        <img src="{{ asset('default-book.png') }}" width="60" height="80">
                    @endif
                </td>
                <td><strong>{{ $book->title }}</strong></td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->category->name ?? '-' }}</td>
                <td>{{ $book->isbn }}</td>
                <td><strong>{{ $book->stock }}</strong></td>
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
                <td colspan="9">Tidak ada data buku</td>
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