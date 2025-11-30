@extends('layouts.admin')

@section('title', 'Data peminjaman')
@section('page-title', 'Data peminjaman')

@section('content')
<style>
    /* Modern Red Theme - Admin Borrowings Page */
    * {
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #fff 0%, #fff5f5 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Page Header */
    .page-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 3px solid #dc3545;
    }

    .page-header h2 {
        color: #dc3545;
        font-size: 2.25rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-header h2::before {
        content: '📚';
        font-size: 2rem;
    }

    /* Filter Section */
    .filter-section {
        background: white;
        border-radius: 16px;
        padding: 1.75rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(220, 53, 69, 0.08);
        border: 1px solid #ffe5e8;
    }

    .filter-group {
        display: grid;
        grid-template-columns: 2fr 1.5fr 1.5fr 1.5fr auto auto;
        gap: 1rem;
        align-items: center;
    }

    .filter-group input[type="text"],
    .filter-group input[type="date"],
    .filter-group select {
        padding: 0.75rem 1rem;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 0.95rem;
        background: #f8f9fa;
        transition: all 0.3s ease;
        width: 100%;
    }

    .filter-group input[type="text"]:focus,
    .filter-group input[type="date"]:focus,
    .filter-group select:focus {
        outline: none;
        border-color: #dc3545;
        background: white;
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1);
    }

    .filter-group select {
        cursor: pointer;
    }

    /* Buttons */
    .btn {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
    }

    .btn-secondary:hover {
        background: linear-gradient(135deg, #c82333, #bd2130);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
    }

    .btn-link {
        background: transparent;
        color: #6c757d;
        border: 2px solid #dee2e6;
    }

    .btn-link:hover {
        background: #f8f9fa;
        color: #dc3545;
        border-color: #dc3545;
    }

    /* Statistics Row */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-mini-card {
        background: white;
        border-radius: 16px;
        padding: 1.75rem;
        box-shadow: 0 4px 20px rgba(220, 53, 69, 0.08);
        border: 1px solid #ffe5e8;
        border-left: 4px solid #dc3545;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-mini-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(220, 53, 69, 0.1), transparent);
        border-radius: 50%;
        transform: translate(30%, -30%);
    }

    .stat-mini-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(220, 53, 69, 0.15);
        border-left-width: 6px;
    }

    .stat-mini-card h4 {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 600;
        margin: 0 0 0.75rem 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-mini-card p {
        color: #333;
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .stat-mini-card p.text-danger {
        color: #dc3545;
    }

    /* Table Container */
    .table-container {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(220, 53, 69, 0.08);
        margin-bottom: 2rem;
        border: 1px solid #ffe5e8;
    }

    /* Data Table */
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
    }

    .data-table th {
        padding: 1.25rem 1.5rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .data-table tbody tr {
        border-bottom: 1px solid #f8f9fa;
        transition: all 0.3s ease;
    }

    .data-table tbody tr:hover {
        background: linear-gradient(90deg, #fff5f5, #fff);
        transform: scale(1.005);
    }

    .data-table tbody tr:last-child {
        border-bottom: none;
    }

    .data-table td {
        padding: 1.25rem 1.5rem;
        color: #333;
        font-size: 0.95rem;
    }

    .data-table td a {
        color: #dc3545;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .data-table td a:hover {
        color: #c82333;
        text-decoration: underline;
    }

    /* Badges */
    .badge {
        display: inline-block;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    .badge-danger {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
    }

    .badge-warning {
        background: linear-gradient(135deg, #ffc107, #e0a800);
        color: #333;
    }

    .badge-success {
        background: linear-gradient(135deg, #28a745, #218838);
        color: white;
    }

    .badge-info {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
    }

    .badge-secondary {
        background: linear-gradient(135deg, #6c757d, #5a6268);
        color: white;
    }

    /* Text Colors */
    .text-danger {
        color: #dc3545;
        font-weight: 700;
    }

    /* Empty State */
    .data-table tbody tr td[colspan] {
        text-align: center;
        padding: 4rem 2rem;
        color: #6c757d;
        font-size: 1.1rem;
        font-weight: 500;
    }

    /* Pagination Container */
    .pagination-container {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(220, 53, 69, 0.08);
        border: 1px solid #ffe5e8;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .filter-group {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .page-header h2 {
            font-size: 1.75rem;
        }

        .filter-group {
            grid-template-columns: 1fr;
        }

        .stats-row {
            grid-template-columns: 1fr;
        }

        .table-container {
            overflow-x: auto;
        }

        .data-table {
            min-width: 900px;
        }

        .data-table th,
        .data-table td {
            padding: 1rem;
            font-size: 0.85rem;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .filter-section,
    .stat-mini-card,
    .table-container {
        animation: fadeInUp 0.6s ease-out;
    }

    .stat-mini-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .stat-mini-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .stat-mini-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .stat-mini-card:nth-child(4) {
        animation-delay: 0.4s;
    }

    /* Scroll behavior */
    html {
        scroll-behavior: smooth;
    }

    /* Custom Scrollbar */
    .table-container::-webkit-scrollbar {
        height: 8px;
    }

    .table-container::-webkit-scrollbar-track {
        background: #f8f9fa;
        border-radius: 10px;
    }

    .table-container::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #dc3545, #c82333);
        border-radius: 10px;
    }

    .table-container::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #c82333, #bd2130);
    }
</style>

<div class="page-header">
    <h2>Data Peminjaman Buku</h2>
</div>

<!-- Filter & Search -->
<div class="filter-section">
    <form method="GET" action="{{ route('admin.borrowings.index') }}">
        <div class="filter-group">
            <input type="text" name="search" placeholder="🔍 Cari peminjam atau buku..." value="{{ request('search') }}">
            
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
        <h4>Total Peminjaman</h4>
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
                <th>Peminjam</th>
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
                <td colspan="8">
                    📭 Tidak ada data peminjaman
                </td>
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