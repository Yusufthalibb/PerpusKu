{{-- resources/views/petugas/borrowings/show.blade.php --}}
@extends('layouts.petugas')

@section('title', 'Detail peminjaman')
@section('page-title', 'Detail peminjaman')

@section('content')
<div class="page-header">
    <h2>Detail peminjaman #{{ $borrowing->id }}</h2>
    <div class="page-actions">
        @if($borrowing->status == 'borrowed')
            <a href="{{ route('petugas.borrowings.edit', $borrowing->id) }}" class="btn btn-success">Proses Pengembalian</a>
        @endif
        <a href="{{ route('petugas.borrowings.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>
</div>

<div class="detail-container">
    <div class="detail-card">
        <h3>Informasi peminjaman</h3>
        <table class="detail-table">
            <tr>
                <th>ID peminjaman</th>
                <td>{{ $borrowing->id }}</td>
            </tr>
            <tr>
                <th>peminjam</th>
                <td>
                    <a href="{{ route('petugas.users.profile', $borrowing->user_id) }}">
                        {{ $borrowing->user->name }}
                    </a>
                </td>
            </tr>
            <tr>
                <th>Buku</th>
                <td>{{ $borrowing->book->title }} - {{ $borrowing->book->author }}</td>
            </tr>
            <tr>
                <th>Tanggal Pinjam</th>
                <td>{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Tenggat Kembali</th>
                <td>{{ \Carbon\Carbon::parse($borrowing->due_date)->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Tanggal Kembali</th>
                <td>{{ $borrowing->return_date ? \Carbon\Carbon::parse($borrowing->return_date)->format('d F Y') : '-' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    @if($borrowing->status == 'returned')
                        <span class="badge badge-success">Dikembalikan</span>
                    @elseif(\Carbon\Carbon::parse($borrowing->due_date)->isPast())
                        <span class="badge badge-danger">Terlambat</span>
                    @else
                        <span class="badge badge-warning">Dipinjam</span>
                    @endif
                </td>
            </tr>
            @if($borrowing->fine && $borrowing->fine > 0)
            <tr>
                <th>Denda</th>
                <td class="text-danger">Rp {{ number_format($borrowing->fine, 0, ',', '.') }}</td>
            </tr>
            @endif
            @if($borrowing->notes)
            <tr>
                <th>Catatan</th>
                <td>{{ $borrowing->notes }}</td>
            </tr>
            @endif
        </table>
    </div>
</div>
@endsection