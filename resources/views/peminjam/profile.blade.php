@extends('layouts.peminjam')

@section('title', 'Profil Saya')

@section('content')

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

</div>




        <!-- Change Password -->
        <div class="profile-card">
            <h3>Ubah Password</h3>

            <form method="POST" action="{{ route('peminjam.profile.update') }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="current_password">Password Saat Ini</label>
                    <input type="password" name="current_password">
                    @error('current_password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password" name="password">
                    <small>Minimal 8 karakter</small>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation">
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

</div>
@endsection
