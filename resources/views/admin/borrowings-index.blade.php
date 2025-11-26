@extends('layouts.admin')

@section('title', 'Data peminjaman')
@section('page-title', 'Data peminjaman')

@section('content')
<div class="page-header">
    <h2>Data peminjaman Buku</h2>
</div>

<!-- Filter & Search -->
<div class="filter-section">
    <form method="GET" action="{{ route('admin.borrowings.index') }}">
        <div class="filter-group">
            <input type="text" name="search" placeholder="Cari peminjam atau buku..." value="{{ request('search') }}">
            
            <select name="status">
                <option value="">Semua Status</option>
                <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
                <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Dikembalikan</option>
                <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Terlambat</option>
            </select>

            <input type="date" name="date_from" value="{{ request('date_from') }}" placeholder="Dari Tanggal">
            <input type="date" name="date_to" value="{{ request('date_to') }}" placeholder="Sampai Tanggal">
            
            <button type="submit" class="btn btn-secondary">Filter</button>
            <a href="{{ route('admin.borrowings.index') }}" class="btn btn-link">Reset</a>
        </div>
    </form>
</div>

<!-- Statistics Cards -->
<div class="stats-row">
    <div class="stat-mini-card">
        <h4>Total peminjaman</h4>
        <p>{{ $totalBorrowings ?? 0 }}</p>
    </div>
    <div class="stat-mini-card">
        <h4>Sedang Dipinjam</h4>
        <p>{{ $activeBorrowings ?? 0 }}</p>
    </div>
    <div class="stat-mini-card">
        <h4>Sudah Dikembalikan</h4>
        <p>{{ $returnedBorrowings ?? 0 }}</p>
    </div>
    <div class="stat-mini-card">
        <h4>Terlambat</h4>
        <p class="text-danger">{{ $lateBorrowings ?? 0 }}</p>
    </div>
</div>

<!-- Borrowings Table -->
<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>peminjam</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tenggat Kembali</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowings as $borrowing)
            <tr>
                <td>{{ $borrowing->id }}</td>
                <td>
                    <a href="{{ route('admin.users.show', $borrowing->user_id) }}">
                        {{ $borrowing->user->name }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('admin.books.show', $borrowing->book_id) }}">
                        {{ $borrowing->book->title }}
                    </a>
                </td>
                <td>{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($borrowing->due_date)->format('d M Y') }}</td>
                <td>
                    {{ $borrowing->return_date ? \Carbon\Carbon::parse($borrowing->return_date)->format('d M Y') : '-' }}
                </td>
                <td>
                    @if($borrowing->status == 'borrowed')
                        @if(\Carbon\Carbon::parse($borrowing->due_date)->isPast())
                            <span class="badge badge-danger">Terlambat</span>
                        @else
                            <span class="badge badge-warning">Dipinjam</span>
                        @endif
                    @elseif($borrowing->status == 'returned')
                        <span class="badge badge-success">Dikembalikan</span>
                    @else
                        <span class="badge badge-{{ $borrowing->status }}">{{ ucfirst($borrowing->status) }}</span>
                    @endif
                </td>
                <td>
                    @if($borrowing->fine && $borrowing->fine > 0)
                        <span class="text-danger">Rp {{ number_format($borrowing->fine, 0, ',', '.') }}</span>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center;">Tidak ada data peminjaman</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="pagination-container">
    {{ $borrowings->links() }}
</div>
@endsection