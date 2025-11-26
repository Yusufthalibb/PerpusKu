{{-- resources/views/petugas/borrowings/index.blade.php --}}
@extends('layouts.petugas')

@section('title', 'peminjaman Aktif')
@section('page-title', 'peminjaman Aktif')

@section('content')
<div class="page-header">
    <h2>Daftar peminjaman Aktif</h2>
    <div class="page-actions">
        <a href="{{ route('petugas.borrowings.create') }}" class="btn btn-primary">+ Tambah peminjaman</a>
        <a href="{{ route('petugas.borrowings.history') }}" class="btn btn-secondary">Riwayat</a>
    </div>
</div>

<div class="filter-section">
    <form method="GET" action="{{ route('petugas.borrowings.index') }}">
        <div class="filter-group">
            <input type="text" name="search" placeholder="Cari peminjam atau buku..." value="{{ request('search') }}">
            <select name="status">
                <option value="">Semua Status</option>
                <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
                <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Terlambat</option>
            </select>
            <button type="submit" class="btn btn-secondary">Filter</button>
            <a href="{{ route('petugas.borrowings.index') }}" class="btn btn-link">Reset</a>
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
                <th>Tenggat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowings as $borrowing)
            <tr>
                <td>{{ $borrowing->id }}</td>
                <td>
                    <a href="{{ route('petugas.users.profile', $borrowing->user_id) }}">
                        {{ $borrowing->user->name }}
                    </a>
                </td>
                <td>{{ $borrowing->book->title }}</td>
                <td>{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}</td>
                <td>
    @php
        $due = \Carbon\Carbon::parse($borrowing->due_date);
    @endphp

    {{ $due->format('d M Y') }}

    @if($due->isToday())
        <span class="badge badge-warning">Jatuh Tempo Hari Ini</span>
    @elseif($due->isPast())
        <span class="badge badge-danger">Terlambat {{ $due->diffInDays(today()) }} hari</span>
    @endif
</td>

               <td>
    @php $due = \Carbon\Carbon::parse($borrowing->due_date); @endphp

    @if($due->isPast() && !$due->isToday())
        <span class="badge badge-danger">Terlambat</span>
    @else
        <span class="badge badge-warning">Dipinjam</span>
    @endif
</td>

                <td class="action-buttons">
                    <a href="{{ route('petugas.borrowings.show', $borrowing->id) }}" class="btn btn-sm btn-info">Detail</a>
                    <a href="{{ route('petugas.borrowings.edit', $borrowing->id) }}" class="btn btn-sm btn-success">Proses Pengembalian</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;">Tidak ada peminjaman aktif</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-container">
    {{ $borrowings->links() }}
</div>
@endsection