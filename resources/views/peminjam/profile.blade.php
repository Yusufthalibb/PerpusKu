@extends('layouts.peminjam')

@section('title', 'Profil Saya')

@section('content')
<style>
    /* Modern Red Theme Profile Page */
    * {
        box-sizing: border-box;
    }

    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    h2 {
        color: #dc3545;
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 3px solid #dc3545;
    }

    h3 {
        color: #333;
        font-weight: 600;
        font-size: 1.4rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    h3::before {
        content: '';
        width: 4px;
        height: 24px;
        background: linear-gradient(135deg, #dc3545, #c82333);
        border-radius: 2px;
    }

    /* Alert Styles */
    .alert {
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        border: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .alert-success {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
        border-left: 4px solid #28a745;
    }

    .alert-danger {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        color: #721c24;
        border-left: 4px solid #dc3545;
    }

    .alert ul {
        margin: 0;
        padding-left: 1.25rem;
    }

    /* Profile Container */
    .profile-container {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(220, 53, 69, 0.08);
        margin-bottom: 2rem;
        border: 1px solid #ffe5e8;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-control:focus {
        outline: none;
        border-color: #dc3545;
        background: white;
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    input[type="file"].form-control {
        padding: 0.5rem;
        background: white;
    }

    /* Profile Image */
    .form-group img.rounded {
        border-radius: 12px !important;
        border: 3px solid #dc3545;
        padding: 4px;
        background: white;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
    }

    /* Buttons */
    .btn {
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-block;
        text-decoration: none;
        text-align: center;
    }

    .btn-primary {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #c82333, #bd2130);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }

    .btn-info {
        background: #17a2b8;
        color: white;
    }

    .btn-info:hover {
        background: #138496;
        transform: translateY(-2px);
    }

    /* HR Divider */
    hr {
        border: none;
        height: 2px;
        background: linear-gradient(90deg, transparent, #dc3545, transparent);
        margin: 2rem 0;
    }

    /* Profile Card */
    .profile-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(220, 53, 69, 0.08);
        border: 1px solid #ffe5e8;
        transition: all 0.3s ease;
    }

    .profile-card:hover {
        box-shadow: 0 8px 30px rgba(220, 53, 69, 0.15);
        transform: translateY(-4px);
    }

    /* Form Group in Profile Card */
    .profile-card .form-group {
        margin-bottom: 1.5rem;
    }

    .profile-card .form-group input {
        width: 100%;
    }

    .profile-card .form-group small {
        display: block;
        color: #6c757d;
        margin-top: 0.25rem;
        font-size: 0.875rem;
    }

    .error-message {
        color: #dc3545;
        font-size: 0.875rem;
        display: block;
        margin-top: 0.25rem;
        font-weight: 500;
    }

    .form-actions {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 2px solid #f8f9fa;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    .info-item {
        padding: 1.25rem;
        background: linear-gradient(135deg, #f8f9fa, #fff);
        border-radius: 12px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        border-color: #dc3545;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.1);
        transform: translateY(-2px);
    }

    .info-item label {
        display: block;
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 0.5rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-item p {
        margin: 0;
        font-size: 1.1rem;
        color: #333;
        font-weight: 600;
    }

    /* Badges */
    .badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    .badge-peminjam {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
    }

    .badge-success {
        background: linear-gradient(135deg, #28a745, #218838);
        color: white;
    }

    .badge-warning {
        background: linear-gradient(135deg, #ffc107, #e0a800);
        color: #333;
    }

    .badge-dipinjam, .badge-pending {
        background: linear-gradient(135deg, #ffc107, #e0a800);
        color: #333;
    }

    .badge-dikembalikan, .badge-returned {
        background: linear-gradient(135deg, #28a745, #218838);
        color: white;
    }

    .badge-terlambat, .badge-overdue {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
    }

    /* Stats List */
    .stats-list {
        display: grid;
        gap: 1.25rem;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.25rem;
        background: linear-gradient(135deg, #fff, #f8f9fa);
        border-radius: 12px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        border-color: #dc3545;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.1);
        transform: translateX(5px);
    }

    .stat-icon {
        font-size: 2rem;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #ffe5e8, #fff);
        border-radius: 12px;
        border: 2px solid #dc3545;
    }

    .stat-info {
        flex: 1;
    }

    .stat-info label {
        display: block;
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
        font-weight: 500;
    }

    .stat-info strong {
        display: block;
        font-size: 1.3rem;
        color: #333;
        font-weight: 700;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    /* Data Table */
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-top: 1rem;
    }

    .data-table thead tr {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
    }

    .data-table th {
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .data-table th:first-child {
        border-top-left-radius: 10px;
    }

    .data-table th:last-child {
        border-top-right-radius: 10px;
    }

    .data-table tbody tr {
        background: white;
        transition: all 0.3s ease;
        border-bottom: 1px solid #e9ecef;
    }

    .data-table tbody tr:hover {
        background: #fff5f5;
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.1);
    }

    .data-table td {
        padding: 1rem;
        color: #333;
    }

    .data-table td strong {
        color: #dc3545;
        font-weight: 600;
    }

    .data-table td small {
        color: #6c757d;
        font-size: 0.875rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #6c757d;
        font-size: 1.1rem;
        background: linear-gradient(135deg, #f8f9fa, #fff);
        border-radius: 12px;
        border: 2px dashed #dee2e6;
    }

    /* Account Actions */
    .account-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .account-actions .btn {
        flex: 1;
        min-width: 200px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-container, .profile-card {
            padding: 1.5rem;
        }

        h2 {
            font-size: 1.5rem;
        }

        h3 {
            font-size: 1.2rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .account-actions {
            flex-direction: column;
        }

        .account-actions .btn {
            width: 100%;
        }

        .data-table {
            font-size: 0.9rem;
        }

        .data-table th,
        .data-table td {
            padding: 0.75rem 0.5rem;
        }
    }

    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .profile-container, .profile-card {
        animation: fadeIn 0.5s ease-out;
    }
</style>

<h2>Profil Saya</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="profile-container">
    {{-- =======================
        EDIT PROFIL
    ======================== --}}
    <form method="POST" action="{{ route('peminjam.profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Foto Profil</label><br>
            @if(auth()->user()->image)
                <img src="{{ asset('storage/' . auth()->user()->image) }}" width="80" class="rounded mb-2">
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Nama *</label>
            <input type="text" class="form-control" name="name"
                   value="{{ old('name', auth()->user()->name) }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Username *</label>
            <input type="text" class="form-control" name="username"
                   value="{{ old('username', auth()->user()->username) }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Email *</label>
            <input type="email" class="form-control" name="email"
                   value="{{ old('email', auth()->user()->email) }}" required>
        </div>

        <div class="form-group mb-3">
            <label>No. Telepon</label>
            <input type="text" class="form-control" name="phone"
                   value="{{ old('phone', auth()->user()->phone) }}">
        </div>

        <div class="form-group mb-3">
            <label>Alamat</label>
            <textarea class="form-control" name="address" rows="3">{{ old('address', auth()->user()->address) }}</textarea>
        </div>

        <button class="btn btn-primary">Simpan Perubahan</button>
    </form>

    <hr>

    <!-- Change Password -->
    <div style="margin-top: 2rem;">
        <h3>Ubah Password</h3>

        <form method="POST" action="{{ route('peminjam.profile.update') }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="current_password">Password Saat Ini</label>
                <input type="password" name="current_password" class="form-control">
                @error('current_password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <input type="password" name="password" class="form-control">
                <small>Minimal 8 karakter</small>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">🔒 Ubah Password</button>
            </div>
        </form>
    </div>
</div>

<!-- Account Information -->
<div class="profile-card">
    <h3>Informasi Akun</h3>
    <div class="info-grid">

        <div class="info-item">
            <label>User ID</label>
            <p>{{ auth()->user()->id }}</p>
        </div>

        <div class="info-item">
            <label>Role</label>
            <p><span class="badge badge-peminjam">peminjam</span></p>
        </div>

        <div class="info-item">
            <label>Email Terverifikasi</label>
            <p>
                @if(auth()->user()->email_verified_at)
                    <span class="badge badge-success">✓ Terverifikasi</span>
                @else
                    <span class="badge badge-warning">Belum Terverifikasi</span>
                @endif
            </p>
        </div>

        <div class="info-item">
            <label>Tanggal Bergabung</label>
            <p>{{ auth()->user()->created_at->format('d F Y') }}</p>
        </div>

    </div>
</div>

<!-- Borrowing Stats -->
<div class="profile-card">
    <h3>Statistik peminjaman</h3>

    <div class="stats-list">
        <div class="stat-item">
            <span class="stat-icon">📚</span>
            <div class="stat-info">
                <label>Total peminjaman</label>
                <strong>{{ $totalBorrowings }} buku</strong>
            </div>
        </div>

        <div class="stat-item">
            <span class="stat-icon">📖</span>
            <div class="stat-info">
                <label>Sedang Dipinjam</label>
                <strong>{{ $activeBorrowings }} buku</strong>
            </div>
        </div>

        <div class="stat-item">
            <span class="stat-icon">✅</span>
            <div class="stat-info">
                <label>Dikembalikan</label>
                <strong>{{ $returnedBorrowings }} buku</strong>
            </div>
        </div>

        <div class="stat-item">
            <span class="stat-icon">⚠️</span>
            <div class="stat-info">
                <label>Keterlambatan</label>
                <strong class="text-danger">{{ $lateBorrowings }} kali</strong>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="profile-card">
    <h3>Aktivitas peminjaman Terakhir</h3>

    @if($recentBorrowings->count() > 0)
    <table class="data-table">
        <thead>
            <tr>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentBorrowings as $borrowing)
            <tr>
                <td>
                    <strong>{{ $borrowing->book->title }}</strong>
                    <br>
                    <small>{{ $borrowing->book->author }}</small>
                </td>
                <td>{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}</td>
                <td><span class="badge badge-{{ $borrowing->status }}">{{ ucfirst($borrowing->status) }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="empty-state">Belum ada aktivitas peminjaman.</p>
    @endif
</div>

<!-- Account Actions -->
<div class="profile-card">
    <h3>Pengaturan Tambahan</h3>
    <div class="account-actions">
        <button type="button" class="btn btn-secondary" onclick="window.print()">📄 Cetak Informasi Akun</button>
        <a href="{{ route('peminjam.borrowings.index') }}" class="btn btn-info">📚 Lihat peminjaman Saya</a>
    </div>
</div>

@endsection