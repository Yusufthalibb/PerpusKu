@extends('layouts.petugas')

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

    .page-header-modern {
        background: linear-gradient(135deg, var(--primary-red) 0%, var(--red-hover) 100%);
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-lg);
    }

    .page-header-modern h3 {
        color: white;
        font-size: 1.875rem;
        font-weight: 700;
        margin: 0;
        letter-spacing: -0.025em;
    }

    .table-container-modern {
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
        margin-bottom: 1.5rem;
    }

    .table-modern {
        width: 100%;
        border-collapse: collapse;
    }

    .table-modern thead {
        background: linear-gradient(135deg, var(--primary-red) 0%, var(--red-hover) 100%);
    }

    .table-modern thead th {
        padding: 1rem 1.25rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.875rem;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border: none;
    }

    .table-modern tbody tr {
        border-bottom: 1px solid var(--gray-200);
        transition: all 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background-color: var(--red-light);
    }

    .table-modern tbody tr:last-child {
        border-bottom: none;
    }

    .table-modern tbody td {
        padding: 1rem 1.25rem;
        font-size: 0.875rem;
        color: var(--gray-700);
        border: none;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .btn-modern {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.813rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-success-modern {
        background-color: var(--green-500);
        color: white;
        box-shadow: var(--shadow-sm);
    }

    .btn-success-modern:hover {
        background-color: var(--green-600);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-danger-modern {
        background-color: var(--primary-red);
        color: white;
        box-shadow: var(--shadow-sm);
    }

    .btn-danger-modern:hover {
        background-color: var(--red-hover);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .pagination-container {
        margin-top: 1.5rem;
        display: flex;
        justify-content: center;
    }

    .empty-state {
        padding: 3rem 1.25rem;
        text-align: center;
        color: var(--gray-600);
        font-style: italic;
    }

    /* Badge for datetime */
    .datetime-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.75rem;
        background-color: var(--gray-100);
        border-radius: 6px;
        font-size: 0.813rem;
        color: var(--gray-700);
        font-weight: 500;
    }

    .user-name {
        font-weight: 600;
        color: var(--gray-800);
    }

    .book-title {
        color: var(--gray-700);
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .table-container-modern {
            overflow-x: auto;
        }

        .table-modern {
            min-width: 700px;
        }

        .action-buttons {
            flex-direction: column;
            width: 100%;
        }

        .btn-modern {
            width: 100%;
            justify-content: center;
        }
    }

    /* Icon styles */
    .btn-modern::before {
        content: '';
        display: inline-block;
        width: 16px;
        height: 16px;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }

    .btn-success-modern::before {
        content: '✓';
        background: none;
        font-weight: bold;
        font-size: 1rem;
    }

    .btn-danger-modern::before {
        content: '✕';
        background: none;
        font-weight: bold;
        font-size: 1rem;
    }
</style>

<div class="page-header-modern">
    <h3>Pengajuan Peminjaman Buku</h3>
</div>

<div class="table-container-modern">
    <table class="table-modern">
        <thead>
            <tr>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tanggal Pengajuan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($borrowings as $b)
            <tr>
                <td>
                    <span class="user-name">{{ $b->user->name }}</span>
                </td>
                <td>
                    <span class="book-title">{{ $b->book->title }}</span>
                </td>
                <td>
                    <span class="datetime-badge">
                        {{ $b->created_at->format('d M Y H:i') }}
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        <!-- ACC -->
                        <form action="{{ route('petugas.borrowings.approve', $b->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="btn-modern btn-success-modern">ACC</button>
                        </form>

                        <!-- Tolak -->
                        <form action="{{ route('petugas.borrowings.reject', $b->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="btn-modern btn-danger-modern">Tolak</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="empty-state">
                    Tidak ada pengajuan peminjaman saat ini
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-container">
    {{ $borrowings->links() }}
</div>

@endsection