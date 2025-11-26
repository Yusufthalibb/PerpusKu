@extends('layouts.petugas')

@section('title', 'Riwayat peminjaman')
@section('page-title', 'Riwayat peminjaman')

@section('content')
<div class="page-header">
    <h2>Riwayat peminjaman</h2>
    <div class="page-actions">
        <a href="{{ route('petugas.borrowings.index') }}" class="btn btn-secondary">← peminjaman Aktif</a>
    </div>
</div>

<div class="filter-section">
    <form method="GET" action="{{ route('petugas.borrowings.history') }}">
        <div class="filter-group">
            <input type="text" name="search" placeholder="Cari peminjam atau buku..." value="{{ request('search') }}">
            <input type="date" name="date_from" value="{{ request('date_from') }}" placeholder="Dari">
            <input type="date" name="date_to" value="{{ request('date_to') }}" placeholder="Sampai">
            <button type="submit" class="btn btn-secondary">Filter</button>
            <a href="{{ route('petugas.borrowings.history') }}" class="btn btn-link">Reset</a>
        </div>
    </form>
</div>

<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>peminjam</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowings as $borrowing)
            <tr>
                <td>{{ $borrowing->id }}</td>
                <td>{{ $borrowing->user->name }}</td>
                <td>{{ $borrowing->book->title }}</td>
                <td>{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}</td>
                <td>{{ $borrowing->return_date ? \Carbon\Carbon::parse($borrowing->return_date)->format('d M Y') : '-' }}</td>
                <td>
                    <span class="badge badge-{{ $borrowing->status }}">
                        {{ ucfirst($borrowing->status) }}
                    </span>
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
                <td colspan="7" style="text-align: center;">Tidak ada riwayat peminjaman</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-container">
    {{ $borrowings->links() }}
</div>
@endsection