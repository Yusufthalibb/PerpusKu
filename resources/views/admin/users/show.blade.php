@extends('layouts.admin')

@section('title', 'Detail Pengguna')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Pengguna</h1>
            <p class="text-sm text-gray-500 mt-1">Informasi lengkap tentang pengguna</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.edit', $user->id) }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200 transition-all duration-200 group">
                <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                <span class="font-medium">Edit</span>
            </a>
            <a href="{{ route('admin.users.index') }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 group">
                <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="font-medium">Kembali</span>
            </a>
        </div>
    </div>

    <!-- Profile Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Profile Header with Background -->
        <div class="relative h-32 bg-gradient-to-r from-[#D32F2F] to-[#B71C1C]">
            <div class="absolute -bottom-16 left-8">
                @if($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}" 
                         alt="{{ $user->name }}"
                         class="w-32 h-32 rounded-full object-cover ring-4 ring-white shadow-lg">
                @else
                    <div class="w-32 h-32 rounded-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center text-white text-4xl font-bold ring-4 ring-white shadow-lg">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Profile Info -->
        <div class="pt-20 px-8 pb-6">
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                    <p class="text-gray-600 mt-1">@<span class="font-mono">{{ $user->username }}</span></p>
                    <div class="flex items-center gap-2 mt-3">
                        <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-sm font-medium
                            {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700' : '' }}
                            {{ $user->role == 'petugas' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $user->role == 'peminjam' ? 'bg-green-100 text-green-700' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($user->role == 'admin')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                @elseif($user->role == 'petugas')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                @endif
                            </svg>
                            {{ ucfirst($user->role) }}
                        </span>
                        <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            Active
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Bergabung {{ $user->created_at->format('d F Y') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Information Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Contact Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Informasi Kontak
            </h3>
            <div class="space-y-4">
                <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="flex-shrink-0 w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-gray-500 font-medium">Email</p>
                        <p class="text-sm text-gray-900 font-medium truncate">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="flex-shrink-0 w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500 font-medium">Nomor Telepon</p>
                        <p class="text-sm text-gray-900 font-medium">{{ $user->phone ?? '-' }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="flex-shrink-0 w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500 font-medium">Alamat</p>
                        <p class="text-sm text-gray-900">{{ $user->address ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Informasi Akun
            </h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">User ID</p>
                            <p class="text-sm text-gray-900 font-mono font-bold">#{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-50 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Tanggal Bergabung</p>
                            <p class="text-sm text-gray-900 font-medium">{{ $user->created_at->format('d F Y, H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-amber-50 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Terakhir Update</p>
                            <p class="text-sm text-gray-900 font-medium">{{ $user->updated_at->format('d F Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Borrowing History (Only for peminjam) -->
    @if($user->role == 'peminjam')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Riwayat peminjaman
                @if($user->borrowings && $user->borrowings->count() > 0)
                    <span class="ml-2 px-2.5 py-0.5 bg-[#D32F2F] text-white text-xs font-semibold rounded-full">
                        {{ $user->borrowings->count() }}
                    </span>
                @endif
            </h3>
        </div>

        <div class="p-6">
            @if($user->borrowings && $user->borrowings->count() > 0)
                <div class="space-y-4">
                    @foreach($user->borrowings as $borrowing)
                    <div class="flex items-start gap-4 p-4 border border-gray-200 rounded-lg hover:border-[#D32F2F] hover:shadow-sm transition-all group">
                        <!-- Book Cover -->
                        @if($borrowing->book->cover_image)
                            <img src="{{ asset('storage/' . $borrowing->book->cover_image) }}" 
                                 alt="{{ $borrowing->book->title }}"
                                 class="w-16 h-20 object-cover rounded-lg shadow-sm group-hover:shadow-md transition-shadow">
                        @else
                            <div class="w-16 h-20 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                        @endif

                        <!-- Borrowing Info -->
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-900 mb-1 group-hover:text-[#D32F2F] transition-colors">
                                {{ $borrowing->book->title }}
                            </h4>
                            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Pinjam: {{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    Kembali: {{ $borrowing->return_date ? \Carbon\Carbon::parse($borrowing->return_date)->format('d M Y') : '-' }}
                                </span>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        <span class="px-3 py-1.5 rounded-full text-xs font-semibold
                            {{ $borrowing->status == 'borrowed' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $borrowing->status == 'returned' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $borrowing->status == 'overdue' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ ucfirst($borrowing->status) }}
                        </span>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-1">Belum Ada peminjaman</h4>
                    <p class="text-gray-500">Pengguna ini belum memiliki riwayat peminjaman buku</p>
                </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Danger Zone -->
    <div class="bg-white rounded-xl shadow-sm border-2 border-red-200 overflow-hidden">
        <div class="px-6 py-4 bg-red-50 border-b border-red-200">
            <h3 class="text-lg font-semibold text-red-900 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                Danger Zone
            </h3>
        </div>
        <div class="p-6">
            <div class="flex items-start gap-4">
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-900 mb-1">Hapus Pengguna</h4>
                    <p class="text-sm text-gray-600">
                        Menghapus pengguna akan menghilangkan semua data yang terkait. 
                        Tindakan ini tidak dapat dibatalkan dan bersifat permanen.
                    </p>
                </div>
                <button onclick="openDeleteModal()" 
                        class="flex-shrink-0 px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all font-medium shadow-sm hover:shadow-md flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus Pengguna
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full transform transition-all scale-95 opacity-0" id="modalContent">
        <div class="p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus Pengguna</h3>
                    <p class="text-sm text-gray-500 mt-1">Tindakan ini tidak dapat dibatalkan!</p>
                </div>
            </div>
            
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                <p class="text-sm text-red-800">
                    Anda akan menghapus pengguna: 
                    <span class="font-semibold">{{ $user->name }}</span>
                </p>
                <p class="text-xs text-red-600 mt-2">
                    Semua data yang terkait dengan pengguna ini akan hilang secara permanen.
                </p>
            </div>

            <div class="flex gap-3">
                <button onclick="closeDeleteModal()" 
                        class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all font-medium">
                    Batal
                </button>
                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all font-medium">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .bg-white {
        animation: slideUp 0.4s ease-out;
    }

    #deleteModal.show {
        display: flex !important;
        animation: fadeIn 0.3s ease-out;
    }

    #deleteModal.show #modalContent {
        opacity: 1;
        transform: scale(1);
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
</style>

<script>
    function openDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('modalContent');
        
        modal.classList.add('show');
        
        // Trigger animation
        setTimeout(() => {
            modalContent.style.opacity = '1';
            modalContent.style.transform = 'scale(1)';
        }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('modalContent');
        
        modalContent.style.opacity = '0';
        modalContent.style.transform = 'scale(0.95)';
        
        setTimeout(() => {
            modal.classList.remove('show');
        }, 200);
    }

    // Close modal when clicking outside
    document.getElementById('deleteModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });

    // Add staggered animation to cards
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.bg-white');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });

    // Smooth scroll to borrowing history if exists
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('section') === 'borrowings') {
        setTimeout(() => {
            const borrowingSection = document.querySelector('.bg-white:has(h3:contains("Riwayat peminjaman"))');
            if (borrowingSection) {
                borrowingSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }, 500);
    }
</script>
@endsection