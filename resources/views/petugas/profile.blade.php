@extends('layouts.petugas')

@section('title', 'Profil Petugas')
@section('page-title', 'Profil Petugas')

@section('content')

<h2>Profil Petugas</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

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

    {{-- =======================
        FORM UPDATE PROFIL
    ======================== --}}
    <div class="profile-block">
        <h3>Edit Profil</h3>

        <form method="POST" action="{{ route('petugas.profile.update') }}" enctype="multipart/form-data">
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
                <textarea name="address" class="form-control" rows="3">{{ old('address', auth()->user()->address) }}</textarea>
            </div>

            <button class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <hr>

    {{-- =======================
        PASSWORD UPDATE
    ======================== --}}
    <div class="profile-block">
        <h3>Ubah Password</h3>

        <form method="POST" action="{{ route('petugas.profile.update.password') }}">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Password Saat Ini *</label>
                <input type="password" class="form-control" name="current_password">
            </div>

            <div class="form-group mb-3">
                <label>Password Baru *</label>
                <input type="password" class="form-control" name="password">
            </div>

            <div class="form-group mb-3">
                <label>Konfirmasi Password *</label>
                <input type="password" class="form-control" name="password_confirmation">
            </div>

            <button class="btn btn-warning">Update Password</button>
        </form>
    </div>

    <hr>

    {{-- =======================
        INFO AKUN
    ======================== --}}
    <div class="profile-block">
        <h3>Informasi Akun</h3>

        <table class="table">
            <tr>
                <th>User ID</th>
                <td>{{ auth()->user()->id }}</td>
            </tr>
            <tr>
                <th>Username</th>
                <td>{{ auth()->user()->username }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td><span class="badge bg-info">Petugas</span></td>
            </tr>
            <tr>
                <th>Bergabung</th>
                <td>{{ auth()->user()->created_at->format('d F Y') }}</td>
            </tr>
        </table>
    </div>

</div>

@endsection
