@extends('layouts.petugas')
@section('title', 'Riwayat peminjaman')
@section('page-title', 'Riwayat peminjaman')
@section('content')

<style>
    /* Modern Red Theme Styles */
    :root {
        --primary-red: #dc2626;
        --red-hover: #b91c1c;
        --red-light: #fef2f2;
        --red-border: #fecaca;
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

    .btn-secondary {
        background-color: white;
        color: var(--primary-red);
        box-shadow: var(--shadow-sm);
    }

    .btn-secondary:hover {
        background-color: var(--gray-50);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-link {
        background-color: transparent;
        color: var(--gray-600);
        text-decoration: underline;
    }

    .btn-link:hover {
        color: var(--gray-800);
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
    .filter-group input[type="date"] {
        padding: 0.625rem 1rem;
        border: 1.5px solid var(--gray-300);
        border-radius: 8px;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        background-color: white;
        flex: 1;
        min-width: 200px;
    }

    .filter-group input:focus {
        outline: none;
        border-color: var(--primary-red);
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    .filter-group button[type="submit"] {
        background-color: var(--primary-red);
        color: white;
        padding: 0.625rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s ease;
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

    .badge {
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        display: inline-block;
    }

    .badge-returned {
        background-color: #dcfce7;
        color: #166534;
    }

    .badge-borrowed {
        background-color: #fef3c7;
        color: #92400e;
    }

    .badge-overdue {
        background-color: var(--red-light);
        color: var(--red-hover);
    }

    .text-danger {
        color: var(--primary-red);
        font-weight: 600;
    }

    .pagination-container {
        margin-top: 1.5rem;
        display: flex;
        justify-content: center;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .filter-group {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-group input[type="text"],
        .filter-group input[type="date"] {
            width: 100%;
            min-width: auto;
        }

        .table-container {
            overflow-x: auto;
        }

        .data-table {
            min-width: 800px;
        }
    }

    /* Empty State Styling */
    .data-table tbody tr td[colspan] {
        padding: 3rem 1.25rem;
        text-align: center;
        color: var(--gray-600);
        font-style: italic;
    }
</style>

<div class="page-header">
    <h2>Riwayat Peminjaman</h2>
    <div class="page-actions">
        <a href="{{ route('petugas.borrowings.index') }}" class="btn btn-secondary">
            ← Peminjaman Aktif
        </a>
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
                <th>Peminjam</th>
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
                <td colspan="7">Tidak ada riwayat peminjaman</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-container">
    {{ $borrowings->links() }}
</div>

@endsection