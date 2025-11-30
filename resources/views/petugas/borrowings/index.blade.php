{{-- resources/views/petugas/borrowings/index.blade.php --}}
@extends('layouts.petugas')

@section('title', 'Peminjaman Aktif')
@section('page-title', 'Peminjaman Aktif')

@section('content')

<style>
    /* Modern Red Theme Styles */
    :root {
        --primary-red: #dc2626;
        --red-hover: #b91c1c;
        --red-light: #fef2f2;
        --red-border: #fecaca;
        --green-500: #22c55e;
        --green-600: #16a34a;
        --green-50: #f0fdf4;
        --blue-500: #3b82f6;
        --blue-600: #2563eb;
        --blue-50: #eff6ff;
        --orange-500: #f97316;
        --orange-50: #fff7ed;
        --yellow-500: #eab308;
        --yellow-50: #fefce8;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
    }

    body {
        background-color: #ffffff;
        color: var(--gray-800);
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-red) 0%, var(--red-hover) 100%);
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-lg);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-header h2 {
        color: white;
        font-size: 1.875rem;
        font-weight: 700;
        margin: 0;
        letter-spacing: -0.025em;
    }

    .page-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.625rem 1.25rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-primary {
        background-color: white;
        color: var(--primary-red);
        box-shadow: var(--shadow-sm);
    }

    .btn-primary:hover {
        background-color: var(--gray-50);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-secondary {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .btn-secondary:hover {
        background-color: rgba(255, 255, 255, 0.3);
        transform: translateY(-1px);
    }

    .btn-link {
        background-color: transparent;
        color: var(--gray-600);
        text-decoration: underline;
    }

    .btn-link:hover {
        color: var(--gray-800);
    }

    .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.813rem;
    }

    .btn-info {
        background-color: var(--blue-500);
        color: white;
    }

    .btn-info:hover {
        background-color: var(--blue-600);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-success {
        background-color: var(--green-500);
        color: white;
    }

    .btn-success:hover {
        background-color: var(--green-600);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .filter-section {
        background-color: white;
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
    }

    .filter-group {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .filter-group input[type="text"],
    .filter-group select {
        padding: 0.625rem 1rem;
        border: 1.5px solid var(--gray-300);
        border-radius: 8px;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        background-color: white;
        flex: 1;
        min-width: 200px;
    }

    .filter-group input:focus,
    .filter-group select:focus {
        outline: none;
        border-color: var(--primary-red);
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    .filter-group button[type="submit"] {
        background-color: var(--primary-red);
        color: white;
    }

    .filter-group button[type="submit"]:hover {
        background-color: var(--red-hover);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .table-container {
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead {
        background: linear-gradient(135deg, var(--primary-red) 0%, var(--red-hover) 100%);
    }

    .data-table thead th {
        padding: 1rem 1.25rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.875rem;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .data-table tbody tr {
        border-bottom: 1px solid var(--gray-200);
        transition: all 0.2s ease;
    }

    .data-table tbody tr:hover {
        background-color: var(--red-light);
    }

    .data-table tbody tr:last-child {
        border-bottom: none;
    }

    .data-table tbody td {
        padding: 1rem 1.25rem;
        font-size: 0.875rem;
        color: var(--gray-700);
    }

    .data-table tbody td a {
        color: var(--primary-red);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .data-table tbody td a:hover {
        color: var(--red-hover);
        text-decoration: underline;
    }

    .badge {
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        display: inline-block;
        margin-left: 0.5rem;
    }

    .badge-warning {
        background-color: var(--yellow-50);
        color: #854d0e;
        border: 1px solid var(--yellow-500);
    }

    .badge-danger {
        background-color: var(--red-light);
        color: var(--red-hover);
        border: 1px solid var(--red-border);
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .pagination-container {
        margin-top: 1.5rem;
        display: flex;
        justify-content: center;
    }

    /* Empty State Styling */
    .data-table tbody tr td[colspan] {
        padding: 3rem 1.25rem;
        text-align: center;
        color: var(--gray-600);
        font-style: italic;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .page-actions {
            width: 100%;
        }

        .filter-group {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-group input[type="text"],
        .filter-group select {
            width: 100%;
            min-width: auto;
        }

        .table-container {
            overflow-x: auto;
        }

        .data-table {
            min-width: 900px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-sm {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="page-header">
    <h2>Daftar Peminjaman Aktif</h2>
    <div class="page-actions">
        <a href="{{ route('petugas.borrowings.create') }}" class="btn btn-primary">+ Tambah Peminjaman</a>
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
                <th>Peminjam</th>
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
                <td colspan="7">Tidak ada peminjaman aktif</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-container">
    {{ $borrowings->links() }}
</div>

@endsection