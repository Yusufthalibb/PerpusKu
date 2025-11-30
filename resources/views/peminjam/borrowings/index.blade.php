@extends('layouts.peminjam')

@section('title', 'Peminjaman Saya')

@section('content')
<style>
    /* Modern Red Theme - Borrowings Page */
    * {
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #fff 0%, #fff5f5 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .borrowings-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Header Section */
    .page-header {
        margin-bottom: 2.5rem;
    }

    .page-header h1 {
        color: #dc3545;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-header h1::before {
        content: '';
        width: 6px;
        height: 40px;
        background: linear-gradient(135deg, #dc3545, #c82333);
        border-radius: 3px;
    }

    .page-header p {
        color: #6c757d;
        font-size: 1.1rem;
        margin-left: 3rem;
    }

    /* Statistics Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.75rem;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.08);
        border: 1px solid #ffe5e8;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(135deg, #dc3545, #c82333);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.15);
    }

    .stat-card:hover::before {
        width: 8px;
    }

    .stat-card-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-info p:first-child {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-info p:last-child {
        color: #333;
        font-size: 2.25rem;
        font-weight: 700;
    }

    .stat-card.red .stat-info p:last-child {
        color: #dc3545;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .stat-card.red .stat-icon {
        background: linear-gradient(135deg, #ffe5e8, #ffccd2);
        color: #dc3545;
    }

    .stat-card.blue .stat-icon {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        color: #2196f3;
    }

    .stat-card.green .stat-icon {
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        color: #28a745;
    }

    /* Filter Tabs */
    .filter-tabs {
        background: white;
        border-radius: 16px;
        padding: 1rem 1.5rem;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.08);
        margin-bottom: 2.5rem;
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        border: 1px solid #ffe5e8;
    }

    .filter-tab {
        padding: 0.75rem 1.5rem;
        border: 2px solid transparent;
        border-radius: 10px;
        color: #6c757d;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
    }

    .filter-tab:hover {
        color: #dc3545;
        background: #fff5f5;
    }

    .filter-tab.active {
        color: #dc3545;
        background: linear-gradient(135deg, #ffe5e8, #fff);
        border-color: #dc3545;
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.2);
    }

    /* Section Title */
    .section-title {
        color: #333;
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 2px;
        background: linear-gradient(90deg, #dc3545, transparent);
    }

    /* Active Borrowings Cards */
    .borrowings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .borrowing-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.08);
        border: 1px solid #ffe5e8;
        transition: all 0.3s ease;
    }

    .borrowing-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.15);
    }

    .borrowing-card.late {
        border-top: 4px solid #dc3545;
    }

    .borrowing-card.on-time {
        border-top: 4px solid #28a745;
    }

    .late-badge {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
        padding: 0.75rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .card-body {
        padding: 1.75rem;
    }

    .book-info {
        display: flex;
        gap: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .book-cover {
        flex-shrink: 0;
    }

    .book-cover img,
    .book-cover-placeholder {
        width: 100px;
        height: 140px;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .book-cover-placeholder {
        background: linear-gradient(135deg, #e9ecef, #dee2e6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 2.5rem;
    }

    .book-details h3 {
        color: #333;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .book-details p {
        color: #6c757d;
        font-size: 0.95rem;
        margin-bottom: 0.75rem;
    }

    .category-badge {
        display: inline-block;
        background: linear-gradient(135deg, #ffe5e8, #ffccd2);
        color: #dc3545;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .dates-info {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #f8f9fa;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .date-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .date-row span:first-child {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .date-row span:last-child {
        color: #333;
        font-weight: 700;
    }

    .date-row.late span:last-child {
        color: #dc3545;
    }

    .date-row.returned span:last-child {
        color: #28a745;
    }

    .btn-detail {
        display: block;
        width: 100%;
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
        padding: 0.875rem;
        text-align: center;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
    }

    .btn-detail:hover {
        background: linear-gradient(135deg, #c82333, #bd2130);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(220, 53, 69, 0.3);
    }

    /* History Table */
    .history-section {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.08);
        margin-bottom: 2.5rem;
        border: 1px solid #ffe5e8;
    }

    .history-header {
        padding: 1.75rem 2rem;
        border-bottom: 2px solid #f8f9fa;
    }

    .history-header h2 {
        color: #333;
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
    }

    .history-table {
        width: 100%;
        border-collapse: collapse;
    }

    .history-table thead {
        background: linear-gradient(135deg, #dc3545, #c82333);
    }

    .history-table th {
        color: white;
        padding: 1.25rem 1.5rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .history-table tbody tr {
        border-bottom: 1px solid #f8f9fa;
        transition: all 0.3s ease;
    }

    .history-table tbody tr:hover {
        background: #fff5f5;
        transform: scale(1.01);
    }

    .history-table td {
        padding: 1.25rem 1.5rem;
        color: #333;
    }

    .history-table td p {
        margin: 0;
    }

    .history-table td p:first-child {
        font-weight: 700;
        color: #333;
        margin-bottom: 0.25rem;
    }

    .history-table td p:last-child {
        color: #6c757d;
        font-size: 0.9rem;
    }

    /* Status Badges */
    .status-badge {
        display: inline-block;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .status-badge.pending {
        background: linear-gradient(135deg, #fff3cd, #ffe69c);
        color: #856404;
    }

    .status-badge.dipinjam {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
    }

    .status-badge.dikembalikan {
        background: linear-gradient(135deg, #d1ecf1, #bee5eb);
        color: #0c5460;
    }

    .status-badge.terlambat {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        color: #721c24;
    }

    .status-badge.ditolak {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        color: #721c24;
    }

    .status-badge.belum {
        background: linear-gradient(135deg, #fff3cd, #ffe69c);
        color: #856404;
    }

    .fine-amount {
        color: #dc3545;
        font-weight: 700;
        font-size: 1.05rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-state-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 1.5rem;
        color: #dee2e6;
    }

    .empty-state h3 {
        color: #333;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }

    .empty-state p {
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
    }

    .btn-explore {
        display: inline-block;
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
        padding: 0.875rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
    }

    .btn-explore:hover {
        background: linear-gradient(135deg, #c82333, #bd2130);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(220, 53, 69, 0.3);
    }

    /* Rules Section */
    .rules-section {
        background: linear-gradient(135deg, #ffe5e8, #fff);
        border-left: 4px solid #dc3545;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.08);
    }

    .rules-content {
        display: flex;
        gap: 1.5rem;
    }

    .rules-icon {
        flex-shrink: 0;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #dc3545, #c82333);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .rules-body h3 {
        color: #333;
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 1.25rem;
    }

    .rules-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.875rem;
    }

    .rules-list li {
        display: flex;
        gap: 1rem;
        color: #333;
        line-height: 1.6;
    }

    .rules-list li::before {
        content: '•';
        color: #dc3545;
        font-weight: 700;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .rules-list strong {
        color: #dc3545;
        font-weight: 700;
    }

    /* Pagination */
    .pagination-wrapper {
        padding: 1.5rem 2rem;
        border-top: 2px solid #f8f9fa;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .borrowings-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .borrowings-container {
            padding: 1rem;
        }

        .page-header h1 {
            font-size: 1.75rem;
        }

        .page-header h1::before {
            height: 30px;
        }

        .page-header p {
            margin-left: 2rem;
            font-size: 1rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .filter-tabs {
            overflow-x: auto;
        }

        .book-info {
            flex-direction: column;
            text-align: center;
        }

        .history-table {
            font-size: 0.85rem;
        }

        .history-table th,
        .history-table td {
            padding: 0.875rem 0.75rem;
        }

        .rules-content {
            flex-direction: column;
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

    .stat-card,
    .borrowing-card,
    .history-section,
    .rules-section {
        animation: fadeInUp 0.6s ease-out;
    }
</style>

<div class="borrowings-container">
    
    <!-- Header -->
    <div class="page-header">
        <h1>Peminjaman Saya</h1>
        <p>Kelola dan pantau buku yang Anda pinjam</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <!-- Active Borrowings -->
        <div class="stat-card red">
            <div class="stat-card-content">
                <div class="stat-info">
                    <p>Sedang Dipinjam</p>
                    <p>{{ $activeBorrowingsCount ?? 0 }}</p>
                </div>
                <div class="stat-icon">📚</div>
            </div>
        </div>

        <!-- Total Borrowings -->
        <div class="stat-card blue">
            <div class="stat-card-content">
                <div class="stat-info">
                    <p>Total Peminjaman</p>
                    <p>{{ $totalBorrowingsCount ?? 0 }}</p>
                </div>
                <div class="stat-icon">📖</div>
            </div>
        </div>

        <!-- Returned -->
        <div class="stat-card green">
            <div class="stat-card-content">
                <div class="stat-info">
                    <p>Dikembalikan</p>
                    <p>{{ $returnedCount ?? 0 }}</p>
                </div>
                <div class="stat-icon">✅</div>
            </div>
        </div>

        <!-- Late Borrowings -->
        <div class="stat-card red">
            <div class="stat-card-content">
                <div class="stat-info">
                    <p>Terlambat</p>
                    <p>{{ $lateCount ?? 0 }}</p>
                </div>
                <div class="stat-icon">⚠️</div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="filter-tabs">
        <a href="{{ route('peminjam.borrowings.index') }}" class="filter-tab {{ !request('status') ? 'active' : '' }}">
            Semua
        </a>
        <a href="{{ route('peminjam.borrowings.index', ['status' => 'borrowed']) }}" class="filter-tab {{ request('status') == 'borrowed' ? 'active' : '' }}">
            Sedang Dipinjam
        </a>
        <a href="{{ route('peminjam.borrowings.index', ['status' => 'returned']) }}" class="filter-tab {{ request('status') == 'returned' ? 'active' : '' }}">
            Dikembalikan
        </a>
    </div>

    <!-- Active Borrowings Section -->
    @if(isset($activeBorrowings) && $activeBorrowings->count() > 0)
    <div style="margin-bottom: 3rem;">
        <h2 class="section-title">Buku yang Sedang Dipinjam</h2>
        <div class="borrowings-grid">
            @foreach($activeBorrowings as $borrowing)
            <div class="borrowing-card {{ \Carbon\Carbon::parse($borrowing->due_date)->isPast() ? 'late' : 'on-time' }}">
                
                <!-- Late Badge -->
                @if(\Carbon\Carbon::parse($borrowing->due_date)->isPast())
                <div class="late-badge">
                    <span>⚠️</span>
                    <span>Terlambat! Segera kembalikan</span>
                </div>
                @endif

                <div class="card-body">
                    <!-- Book Info -->
                    <div class="book-info">
                        <div class="book-cover">
                            @if ($borrowing->book->image && Storage::disk('public')->exists($borrowing->book->image))
                                <img src="{{ asset('storage/' . $borrowing->book->image) }}" alt="{{ $borrowing->book->title }}">
                            @else
                                <div class="book-cover-placeholder">📕</div>
                            @endif
                        </div>
                        <div class="book-details">
                            <h3>{{ $borrowing->book->title }}</h3>
                            <p>{{ $borrowing->book->author }}</p>
                            <span class="category-badge">
                                {{ $borrowing->book->category->name ?? '-' }}
                            </span>
                        </div>
                    </div>

                    <!-- Dates Info -->
                    <div class="dates-info">
                        <div class="date-row">
                            <span>Tanggal Pinjam</span>
                            <span>{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}</span>
                        </div>
                        <div class="date-row {{ \Carbon\Carbon::parse($borrowing->due_date)->isPast() ? 'late' : '' }}">
                            <span>Tenggat Kembali</span>
                            <span>{{ \Carbon\Carbon::parse($borrowing->due_date)->format('d M Y') }}</span>
                        </div>
                        @if($borrowing->return_date)
                        <div class="date-row returned">
                            <span>Tanggal Dikembalikan</span>
                            <span>{{ \Carbon\Carbon::parse($borrowing->return_date)->format('d M Y') }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Action Button -->
                    <a href="{{ route('peminjam.books.show', $borrowing->book->id) }}" class="btn-detail">
                        Lihat Detail Buku
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Borrowing History Section -->
    <div class="history-section">
        <div class="history-header">
            <h2>Riwayat Peminjaman</h2>
        </div>

        @if($borrowings->count() > 0)
        <div style="overflow-x: auto;">
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrowings as $borrowing)
                    <tr>
                        <td>
                            <p>{{ $borrowing->book->title }}</p>
                            <p>{{ $borrowing->book->author }}</p>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}</td>
                        <td>
                            @if($borrowing->return_date)
                                {{ \Carbon\Carbon::parse($borrowing->return_date)->format('d M Y') }}
                            @else
                                <span class="status-badge belum">Belum dikembalikan</span>
                            @endif
                        </td>
                        <td>
                            @if($borrowing->status == 'pending')
                                <span class="status-badge pending">Menunggu ACC</span>
                            @elseif($borrowing->status == 'dipinjam')
                                <span class="status-badge dipinjam">Dipinjam</span>
                            @elseif($borrowing->status == 'dikembalikan')
                                <span class="status-badge dikembalikan">Selesai</span>
                            @elseif($borrowing->status == 'terlambat')
                                <span class="status-badge terlambat">Terlambat</span>
                            @elseif($borrowing->status == 'ditolak')
                                <span class="status-badge ditolak">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            @if($borrowing->fine && $borrowing->fine > 0)
                                <span class="fine-amount">Rp {{ number_format($borrowing->fine, 0, ',', '.') }}</span>
                            @else
                                <span style="color: #6c757d;">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $borrowings->links() }}
        </div>
        @else
        <div class="empty-state">
            <div class="empty-state-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747 0-6.002-4.5-10.747-10-10.747z"></path>
                </svg>
            </div>
            <h3>Belum Ada Peminjaman</h3>
            <p>Anda belum pernah meminjam buku. Mulai jelajahi katalog kami!</p>
            <a href="{{ route('peminjam.books.index') }}" class="btn-explore">
                Jelajahi Katalog Buku
            </a>
        </div>
        @endif
    </div>

    <!-- Borrowing Rules -->
    <div class="rules-section">
        <div class="rules-content">
            <div class="rules-icon">ℹ️</div>
            <div class="rules-body">
                <h3>Aturan Peminjaman</h3>
                <ul class="rules-list">
                    <li>Durasi peminjaman: <strong>14 hari</strong> dari tanggal peminjaman</li>
                    <li>Denda keterlambatan: <strong>Rp 1.000 per hari</strong></li>
                    <li>Maksimal peminjaman sekaligus: <strong>3 buku</strong></li>
                    <li>Perpanjangan dapat dilakukan <strong>1 kali</strong> sebelum jatuh tempo</li>
                    <li>Hubungi petugas perpustakaan untuk perpanjangan</li>
                    <li>Kembalikan buku dalam kondisi baik</li>
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection