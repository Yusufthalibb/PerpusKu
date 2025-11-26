@extends('layouts.admin')

@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('content')

<h2>Profil Admin</h2>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- ERROR MESSAGE --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="profile-container">

    {{-- ==========================
        FORM UPDATE PROFIL
    ========================== --}}
    <div class="profile-block">
        <h3>Edit Profil</h3>

        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- FOTO PROFIL --}}
            <div class="form-group mb-3">
                <label>Foto Profil</label><br>
                @if($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}" width="80" class="rounded mb-2">
                @endif
                <input type="file" name="image" class="form-control">
            </div>

            {{-- NAME --}}
            <div class="form-group mb-3">
                <label>Nama Lengkap *</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
            </div>

            {{-- USERNAME --}}
            <div class="form-group mb-3">
                <label>Username *</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control" required>
            </div>

            {{-- EMAIL --}}
            <div class="form-group mb-3">
                <label>Email *</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
            </div>

            {{-- PHONE --}}
            <div class="form-group mb-3">
                <label>Nomor Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
            </div>

            {{-- ADDRESS --}}
            <div class="form-group mb-3">
                <label>Alamat</label>
                <textarea name="address" class="form-control" rows="3">{{ old('address', $user->address) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <hr>

    {{-- ==========================
        FORM UBAH PASSWORD
    ========================== --}}
    <div class="profile-block">
        <h3>Ubah Password</h3>

        <form method="POST" action="{{ route('admin.profile.update.password') }}">
            @csrf
            @method('PUT')

            {{-- CURRENT PASSWORD --}}
            <div class="form-group mb-3">
                <label>Password Saat Ini *</label>
                <input type="password" name="current_password" class="form-control">
            </div>

            {{-- NEW PASSWORD --}}
            <div class="form-group mb-3">
                <label>Password Baru *</label>
                <input type="password" name="password" class="form-control">
            </div>

            {{-- CONFIRM --}}
            <div class="form-group mb-3">
                <label>Konfirmasi Password Baru *</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <button type="submit" class="btn btn-warning">Update Password</button>
        </form>
    </div>

    <hr>

    {{-- ==========================
        INFO AKUN
    ========================== --}}
    <div class="profile-block">
        <h3>Informasi Akun</h3>

        <table class="table">
            <tr>
                <th>User ID</th>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td><span class="badge bg-danger">Admin</span></td>
            </tr>
            <tr>
                <th>Tanggal Bergabung</th>
                <td>{{ $user->created_at->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Terakhir Login</th>
                <td>{{ $user->last_login_at ?? 'Tidak tersedia' }}</td>
            </tr>
        </table>
    </div>

</div>

@endsection
