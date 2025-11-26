@extends('layouts.peminjam')
@section('title', 'Dashboard Peminjam')
@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto space-y-8">
        
        <!-- Welcome Section -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#D32F2F] to-[#B71C1C] p-8 shadow-xl">
            <div class="relative z-10">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">
                    Selamat Datang, {{ auth()->user()->name }}! 👋
                </h1>
                <p class="text-red-50 text-lg mb-6">
                    Jelajahi koleksi buku kami dan temukan bacaan favorit Anda
                </p>
                <a href="{{ route('peminjam.books.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-white text-[#D32F2F] font-semibold rounded-lg hover:bg-red-50 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                    </svg>
                    Jelajahi Katalog Buku
                </a>
            </div>
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 -mt-4 -mr-4 h-32 w-32 rounded-full bg-white opacity-10"></div>
            <div class="absolute bottom-0 right-20 -mb-8 h-24 w-24 rounded-full bg-white opacity-10"></div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Active Borrowings Card -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 border-t-4 border-[#D32F2F]">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-red-50 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-2">Sedang Dipinjam</h3>
                
                @if($activeBorrowings->count() > 0)
                    <div class="space-y-3 mt-4" x-data="{ expanded: false }">
                        <div :class="expanded ? '' : 'max-h-48 overflow-hidden'">
                            @foreach($activeBorrowings as $borrow)
                                <div class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded-lg transition-colors">
                                    @if($borrow->book->image)
                                        <img src="{{ asset('storage/' . $borrow->book->image) }}" 
                                             class="w-12 h-16 object-cover rounded shadow-sm" 
                                             alt="{{ $borrow->book->title }}">
                                    @else
                                        <div class="w-12 h-16 bg-gradient-to-br from-red-100 to-red-200 rounded flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $borrow->book->title }}</p>
                                        @if($borrow->status == 'dipinjam')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                                    <polyline points="20 6 9 17 4 12"/>
                                                </svg>
                                                Dipinjam
                                            </span>
                                        @elseif($borrow->status == 'pending')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                                    <circle cx="12" cy="12" r="10"/>
                                                    <polyline points="12 6 12 12 16 14"/>
                                                </svg>
                                                Pending
                                            </span>
                                        @elseif($borrow->status == 'ditolak')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                                    <circle cx="12" cy="12" r="10"/>
                                                    <line x1="15" y1="9" x2="9" y2="15"/>
                                                    <line x1="9" y1="9" x2="15" y2="15"/>
                                                </svg>
                                                Ditolak
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($activeBorrowings->count() > 2)
                            <button @click="expanded = !expanded" class="text-[#D32F2F] text-xs font-medium hover:underline">
                                <span x-show="!expanded">Lihat semua</span>
                                <span x-show="expanded">Lihat lebih sedikit</span>
                            </button>
                        @endif
                    </div>
                @else
                    <p class="text-gray-400 text-sm mt-2">Tidak ada buku yang sedang dipinjam</p>
                @endif
            </div>

            <!-- Total Borrowed Card -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 border-t-4 border-blue-500">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-50 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-2">Total Dipinjam</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $totalBorrowings ?? 0 }}</p>
                <p class="text-gray-500 text-xs mt-1">Total peminjaman</p>
            </div>

            <!-- Due Soon Card -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 border-t-4 border-orange-500">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-orange-50 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#F97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-2">Jatuh Tempo</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $dueSoonCount ?? 0 }}</p>
                <p class="text-gray-500 text-xs mt-1">Dalam 3 hari</p>
            </div>

            <!-- Available Books Card -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 border-t-4 border-green-500">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-50 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-600 text-sm font-medium mb-2">Buku Tersedia</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $availableBooks ?? 0 }}</p>
                <p class="text-gray-500 text-xs mt-1">Siap dipinjam</p>
            </div>
        </div>

        <!-- Due Soon Alert -->
        @if(isset($dueSoon) && $dueSoon->count() > 0)
        <div class="bg-gradient-to-r from-orange-50 to-red-50 border-l-4 border-orange-500 rounded-lg shadow-md p-6" x-data="{ open: true }" x-show="open">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#F97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                        <line x1="12" y1="9" x2="12" y2="13"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                </div>
                <div class="ml-4 flex-1">
                    <h4 class="text-lg font-semibold text-orange-900 mb-3">⚠️ Perhatian! Buku Anda akan jatuh tempo</h4>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-orange-200">
                            <thead class="bg-orange-100">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-orange-900 uppercase tracking-wider">Buku</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-orange-900 uppercase tracking-wider">Tanggal Pinjam</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-orange-900 uppercase tracking-wider">Tenggat Kembali</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-orange-900 uppercase tracking-wider">Sisa Waktu</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-orange-100">
                                @foreach($dueSoon as $borrowing)
                                <tr class="hover:bg-orange-50 transition-colors">
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $borrowing->book->title }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ \Carbon\Carbon::parse($borrowing->due_date)->format('d M Y') }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                                <circle cx="12" cy="12" r="10"/>
                                                <polyline points="12 6 12 12 16 14"/>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($borrowing->due_date)->diffInDays() }} hari lagi
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('peminjam.borrowings.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                                <polyline points="10 17 15 12 10 7"/>
                                <line x1="15" y1="12" x2="3" y2="12"/>
                            </svg>
                            Lihat Detail
                        </a>
                    </div>
                </div>
                <button @click="open = false" class="ml-4 flex-shrink-0 text-orange-500 hover:text-orange-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
        </div>
        @endif

        <!-- Current Borrowings Section -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                    </svg>
                    Buku yang Sedang Dipinjam
                </h3>
                <a href="{{ route('peminjam.borrowings.index') }}" 
                   class="text-[#D32F2F] hover:text-[#B71C1C] font-medium text-sm flex items-center transition-colors">
                    Lihat Semua
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </a>
            </div>

            @if(isset($currentBorrowings) && $currentBorrowings->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($currentBorrowings as $borrowing)
                <div class="group bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative h-64 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                        @if($borrowing->book->cover)
                            <img src="{{ asset('storage/' . $borrowing->book->cover) }}" 
                                 alt="{{ $borrowing->book->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3">
                            <span class="px-2 py-1 bg-[#D32F2F] text-white text-xs font-semibold rounded-full shadow-lg">
                                Dipinjam
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <h4 class="font-semibold text-gray-900 mb-1 line-clamp-2 group-hover:text-[#D32F2F] transition-colors">
                            {{ $borrowing->book->title }}
                        </h4>
                        <p class="text-sm text-gray-600 mb-3">{{ $borrowing->book->author }}</p>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-xs text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1.5">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                Dipinjam: {{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}
                            </div>
                            <div class="flex items-center text-xs text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1.5">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                Tenggat: {{ \Carbon\Carbon::parse($borrowing->due_date)->format('d M Y') }}
                            </div>
                        </div>
                        
                        <a href="{{ route('peminjam.books.show', $borrowing->book->id) }}" 
                           class="block w-full text-center px-4 py-2 bg-gradient-to-r from-[#D32F2F] to-[#B71C1C] text-white text-sm font-medium rounded-lg hover:from-[#B71C1C] hover:to-[#D32F2F] transition-all duration-200 transform hover:scale-105">
                            Detail Buku
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#D1D5DB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-4">
                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                </svg>
                <p class="text-gray-500 mb-4">Anda belum meminjam buku.</p>
                <a href="{{ route('peminjam.books.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-[#D32F2F] text-white font-medium rounded-lg hover:bg-[#B71C1C] transition-colors">
                    Jelajahi Katalog
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </a>
            </div>
            @endif
        </div>

        <!-- Recommended Books Section -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                    </svg>
                    Rekomendasi Buku
                </h3>
                <a href="{{ route('peminjam.books.index') }}" 
                   class="text-[#D32F2F] hover:text-[#B71C1C] font-medium text-sm flex items-center transition-colors">
                    Lihat Semua
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </a>
            </div>

            @if(isset($recommendedBooks) && $recommendedBooks->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($recommendedBooks as $book)
                <div class="group bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative h-64 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" 
                                 alt="{{ $book->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3">
                            @if($book->stock > 0)
                                <span class="px-2 py-1 bg-green-500 text-white text-xs font-semibold rounded-full shadow-lg flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                    Tersedia
                                </span>
                            @else
                                <span class="px-2 py-1 bg-red-500 text-white text-xs font-semibold rounded-full shadow-lg flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="15" y1="9" x2="9" y2="15"/>
                                        <line x1="9" y1="9" x2="15" y2="15"/>
                                    </svg>
                                    Habis
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <h4 class="font-semibold text-gray-900 mb-1 line-clamp-2 group-hover:text-[#D32F2F] transition-colors">
                            {{ $book->title }}
                        </h4>
                        <p class="text-sm text-gray-600 mb-4">{{ $book->author }}</p>
                        
                        <a href="{{ route('peminjam.books.show', $book->id) }}" 
                           class="block w-full text-center px-4 py-2 bg-gradient-to-r from-[#D32F2F] to-[#B71C1C] text-white text-sm font-medium rounded-lg hover:from-[#B71C1C] hover:to-[#D32F2F] transition-all duration-200 transform hover:scale-105">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#D1D5DB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-4">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                </svg>
                <p class="text-gray-500">Tidak ada rekomendasi saat ini.</p>
            </div>
            @endif
        </div>

        <!-- Recent Activity Section -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/>
                    <path d="M21 3v5h-5"/>
                    <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/>
                    <path d="M8 16H3v5"/>
                </svg>
                Riwayat Peminjaman Terakhir
            </h3>

            @if(isset($recentBorrowings) && $recentBorrowings->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kembali</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentBorrowings as $borrowing)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($borrowing->book->image)
                                            <img class="h-10 w-10 rounded object-cover" src="{{ asset('storage/' . $borrowing->book->image) }}" alt="">
                                        @else
                                            <div class="h-10 w-10 rounded bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $borrowing->book->title }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $borrowing->return_date ? \Carbon\Carbon::parse($borrowing->return_date)->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($borrowing->status == 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                            <circle cx="12" cy="12" r="10"/>
                                            <polyline points="12 6 12 12 16 14"/>
                                        </svg>
                                        Menunggu ACC
                                    </span>
                                @elseif($borrowing->status == 'dipinjam')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Dipinjam
                                    </span>
                                @elseif($borrowing->status == 'ditolak')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                            <circle cx="12" cy="12" r="10"/>
                                            <line x1="15" y1="9" x2="9" y2="15"/>
                                            <line x1="9" y1="9" x2="15" y2="15"/>
                                        </svg>
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#D1D5DB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-4">
                    <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/>
                    <path d="M21 3v5h-5"/>
                    <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/>
                    <path d="M8 16H3v5"/>
                </svg>
                <p class="text-gray-500">Belum ada riwayat peminjaman.</p>
            </div>
            @endif
        </div>

    </div>
</div>
@endsection