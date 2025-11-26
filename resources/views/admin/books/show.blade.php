@extends('layouts.admin')

@section('title', 'Detail Buku')
@section('page-title', 'Detail Buku')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8 animate-fadeInUp">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Detail Buku</h1>
                    <p class="text-sm text-gray-500 mt-1">Informasi lengkap tentang buku</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.books.edit', $book->id) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200 transition-all duration-200 font-medium group">
                        <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span class="hidden sm:inline">Edit</span>
                    </a>
                    <a href="{{ route('admin.categories.show', $book->category_id) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-all duration-200 font-medium group">
                        <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <span class="hidden sm:inline">Lihat Kategori</span>
                    </a>
                    <a href="{{ route('admin.books.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span class="hidden sm:inline">Kembali</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Book Info Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Cover Section -->
            <div class="lg:col-span-1 animate-fadeInUp" style="animation-delay: 0.1s">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="aspect-[2/3] rounded-lg overflow-hidden bg-gray-100 mb-4">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" 
                                 alt="{{ $book->title }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                <svg class="w-20 h-20 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm font-medium">No Cover Available</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Stock Badge -->
                    <div class="flex items-center justify-between p-3 rounded-lg {{ $book->stock > 0 ? 'bg-green-50' : 'bg-red-50' }}">
                        <span class="text-sm font-medium {{ $book->stock > 0 ? 'text-green-900' : 'text-red-900' }}">Status Ketersediaan</span>
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 {{ $book->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} text-xs font-medium rounded-full">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                @if($book->stock > 0)
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                @else
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                @endif
                            </svg>
                            {{ $book->stock > 0 ? 'Tersedia' : 'Habis' }}
                        </span>
                    </div>
                    
                    <div class="mt-3 text-center">
                        <p class="text-2xl font-bold text-gray-900">{{ $book->stock }}</p>
                        <p class="text-sm text-gray-500">Unit Tersedia</p>
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="lg:col-span-2 space-y-6 animate-fadeInUp" style="animation-delay: 0.2s">
                <!-- Title Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $book->title }}</h2>
                    <p class="text-lg text-gray-600 mb-4">oleh <span class="font-medium text-gray-900">{{ $book->author }}</span></p>
                    
                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-purple-100 text-purple-700 text-sm font-medium rounded-full">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            {{ $book->category->name ?? '-' }}
                        </span>
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 text-sm font-medium rounded-full">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $book->year }}
                        </span>
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-full">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Rak {{ $book->shelf_code }}
                        </span>
                    </div>
                </div>

                <!-- Detail Info Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Informasi Detail
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-start gap-3 p-3 rounded-lg bg-gray-50">
                            <div class="flex-shrink-0 w-10 h-10 bg-[#D32F2F] bg-opacity-10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-0.5">ISBN</p>
                                <p class="text-sm font-medium text-gray-900">{{ $book->isbn }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3 rounded-lg bg-gray-50">
                            <div class="flex-shrink-0 w-10 h-10 bg-[#D32F2F] bg-opacity-10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-0.5">Penerbit</p>
                                <p class="text-sm font-medium text-gray-900">{{ $book->publisher }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3 rounded-lg bg-gray-50">
                            <div class="flex-shrink-0 w-10 h-10 bg-[#D32F2F] bg-opacity-10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-0.5">Bahasa</p>
                                <p class="text-sm font-medium text-gray-900">{{ $book->language ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3 rounded-lg bg-gray-50">
                            <div class="flex-shrink-0 w-10 h-10 bg-[#D32F2F] bg-opacity-10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-0.5">Jumlah Halaman</p>
                                <p class="text-sm font-medium text-gray-900">{{ $book->pages ?? '-' }} halaman</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3 rounded-lg bg-gray-50">
                            <div class="flex-shrink-0 w-10 h-10 bg-[#D32F2F] bg-opacity-10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-0.5">Ditambahkan</p>
                                <p class="text-sm font-medium text-gray-900">{{ $book->created_at->translatedFormat('d F Y, H:i') }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3 rounded-lg bg-gray-50">
                            <div class="flex-shrink-0 w-10 h-10 bg-[#D32F2F] bg-opacity-10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-0.5">Terakhir Diupdate</p>
                                <p class="text-sm font-medium text-gray-900">{{ $book->updated_at->translatedFormat('d F Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6 animate-fadeInUp" style="animation-delay: 0.3s">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $book->borrowings->count() }}</p>
                        <p class="text-sm text-gray-500">Total Dipinjam</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $book->borrowings->where('status', 'borrowed')->count() }}</p>
                        <p class="text-sm text-gray-500">Sedang Dipinjam</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($book->borrowings->sum('fine'), 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500">Total Denda</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description -->
        @if($book->description)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6 animate-fadeInUp" style="animation-delay: 0.4s">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Deskripsi Buku
            </h3>
            <p class="text-gray-700 leading-relaxed text-justify">{{ $book->description }}</p>
        </div>
        @endif

        <!-- Borrowing History -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden animate-fadeInUp" style="animation-delay: 0.5s">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Riwayat Peminjaman
                </h3>
            </div>

            @if($book->borrowings->count() > 0)
            <!-- Desktop Table -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jatuh Tempo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kembali</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($book->borrowings as $borrowing)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="flex-shrink-0 w-8 h-8 bg-[#D32F2F] bg-opacity-10 rounded-full flex items-center justify-center">
                                        <span class="text-xs font-medium text-[#D32F2F]">{{ substr($borrowing->user->name, 0, 2) }}</span>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">{{ $borrowing->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $borrowing->borrow_date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $borrowing->due_date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $borrowing->return_date ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                    {{ $borrowing->status === 'borrowed' ? 'bg-amber-100 text-amber-700' : '' }}
                                    {{ $borrowing->status === 'returned' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $borrowing->status === 'overdue' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ ucfirst($borrowing->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="md:hidden divide-y divide-gray-200">
                @foreach($book->borrowings as $borrowing)
                <div class="p-4">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0 w-10 h-10 bg-[#D32F2F] bg-opacity-10 rounded-full flex items-center justify-center">
                                <span class="text-sm font-medium text-[#D32F2F]">{{ substr($borrowing->user->name, 0, 2) }}</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $borrowing->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $borrowing->borrow_date }}</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                            {{ $borrowing->status === 'borrowed' ? 'bg-amber-100 text-amber-700' : '' }}
                            {{ $borrowing->status === 'returned' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $borrowing->status === 'overdue' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ ucfirst($borrowing->status) }}
                        </span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div>
                            <p class="text-gray-500">Jatuh Tempo</p>
                            <p class="font-medium text-gray-900">{{ $borrowing->due_date }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Tanggal Kembali</p>
                            <p class="font-medium text-gray-900">{{ $borrowing->return_date ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="p-12">
                <div class="flex flex-col items-center justify-center text-center">
                    <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Belum Ada Peminjaman</h3>
                    <p class="text-sm text-gray-500">Belum ada riwayat peminjaman untuk buku ini</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Danger Zone -->
        <div class="bg-white rounded-xl shadow-sm border-2 border-red-200 overflow-hidden mt-6 animate-fadeInUp" style="animation-delay: 0.6s">
            <div class="bg-red-50 px-6 py-4 border-b border-red-200">
                <h3 class="text-lg font-bold text-red-900 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    Danger Zone
                </h3>
            </div>
            <div class="p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-900 mb-1">Hapus Buku Ini</p>
                        <p class="text-sm text-gray-600">Menghapus buku akan menghapus seluruh riwayat peminjaman terkait. Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                    <button type="button" onclick="confirmDeleteBook()" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200 font-medium whitespace-nowrap group">
                        <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus Buku
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full transform transition-all duration-300 scale-95 opacity-0" id="deleteModalContent">
        <div class="p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Hapus Buku</h3>
                    <p class="text-sm text-gray-500 mt-1">Konfirmasi penghapusan</p>
                </div>
            </div>
            <div class="mb-6">
                <p class="text-sm text-gray-900 font-medium mb-2">Anda yakin ingin menghapus buku ini?</p>
                <div class="p-3 bg-red-50 rounded-lg border border-red-200">
                    <p class="text-sm text-red-800 mb-1 font-medium">{{ $book->title }}</p>
                    <p class="text-xs text-red-600">oleh {{ $book->author }}</p>
                </div>
                <p class="text-sm text-gray-600 mt-3">Menghapus buku akan menghapus:</p>
                <ul class="text-sm text-gray-600 mt-2 space-y-1 ml-4">
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-red-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span>Seluruh riwayat peminjaman ({{ $book->borrowings->count() }} transaksi)</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-red-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span>Data buku permanen dari sistem</span>
                    </li>
                </ul>
                <div class="mt-4 p-3 bg-amber-50 rounded-lg border border-amber-200">
                    <p class="text-xs text-amber-800 flex items-start gap-2">
                        <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>Tindakan ini tidak dapat dibatalkan!</span>
                    </p>
                </div>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 font-medium">
                    Batal
                </button>
                <button type="button" onclick="submitDelete()" class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200 font-medium">
                    Ya, Hapus Buku
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Delete Form -->
<form id="delete-form" method="POST" action="{{ route('admin.books.destroy', $book->id) }}" class="hidden">
    @csrf
    @method('DELETE')
</form>

@push('styles')
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out forwards;
    }
</style>
@endpush

@push('scripts')
<script>
    function confirmDeleteBook() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('deleteModalContent');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('deleteModalContent');
        
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    function submitDelete() {
        document.getElementById('delete-form').submit();
    }

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });

    // Close modal when clicking outside
    document.getElementById('deleteModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
</script>
@endpush
@endsection