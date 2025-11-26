@extends('layouts.peminjam')
@section('title', $book->title)
@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex items-center space-x-2 text-sm" aria-label="Breadcrumb">
                <a href="{{ route('peminjam.dashboard') }}" class="text-gray-500 hover:text-[#D32F2F] transition-colors flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Dashboard
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
                <a href="{{ route('peminjam.books.index') }}" class="text-gray-500 hover:text-[#D32F2F] transition-colors">
                    Katalog
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
                <span class="text-[#D32F2F] font-medium truncate max-w-xs">{{ $book->title }}</span>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Main Book Detail Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <!-- Left Column: Book Cover & Actions -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Book Cover -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden sticky top-8">
                    <div class="relative aspect-[3/4] bg-gradient-to-br from-gray-100 to-gray-200">
                        @if($book->image && file_exists(public_path('storage/' . $book->image)))
                            <img 
                                src="{{ asset('storage/' . $book->image) }}" 
                                alt="{{ $book->title }}"
                                class="w-full h-full object-cover"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                                </svg>
                            </div>
                        @endif

                        <!-- Stock Badge Overlay -->
                        <div class="absolute top-4 right-4">
                            @if($book->stock > 0)
                                <span class="px-3 py-1.5 bg-green-500 text-white text-sm font-bold rounded-full shadow-lg flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                    Tersedia
                                </span>
                            @else
                                <span class="px-3 py-1.5 bg-red-500 text-white text-sm font-bold rounded-full shadow-lg flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="15" y1="9" x2="9" y2="15"/>
                                        <line x1="9" y1="9" x2="15" y2="15"/>
                                    </svg>
                                    Habis
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Availability Card -->
                    <div class="p-6">
                        <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            Status Ketersediaan
                        </h4>

                        @if($book->stock > 0)
                            <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                        <polyline points="22 4 12 14.01 9 11.01"/>
                                    </svg>
                                    <span class="text-green-800 font-semibold text-lg">Tersedia</span>
                                </div>
                                <p class="text-green-700 text-sm">
                                    Stok tersisa: <strong class="text-lg">{{ $book->stock }}</strong> buku
                                </p>
                            </div>

                            @if(!$hasActiveBorrowing)
                                <form method="POST" action="{{ route('peminjam.borrow.store', $book->id) }}" x-data="{ submitting: false }">
                                    @csrf
                                    <button 
                                        type="submit" 
                                        @click="if(!confirm('Yakin ingin meminjam buku ini?')) { $event.preventDefault(); } else { submitting = true; }"
                                        :disabled="submitting"
                                        class="w-full px-6 py-4 bg-gradient-to-r from-[#D32F2F] to-[#B71C1C] text-white font-bold rounded-lg hover:from-[#B71C1C] hover:to-[#D32F2F] transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                                        </svg>
                                        <span x-show="!submitting">Pinjam Buku Ini</span>
                                        <span x-show="submitting" class="flex items-center">
                                            <svg class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Memproses...
                                        </span>
                                    </button>
                                </form>
                            @else
                                <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                            <circle cx="12" cy="12" r="10"/>
                                            <line x1="12" y1="16" x2="12" y2="12"/>
                                            <line x1="12" y1="8" x2="12.01" y2="8"/>
                                        </svg>
                                        <p class="text-blue-800 font-medium text-sm">Anda sudah meminjam buku ini</p>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="15" y1="9" x2="9" y2="15"/>
                                        <line x1="9" y1="9" x2="15" y2="15"/>
                                    </svg>
                                    <span class="text-red-800 font-semibold text-lg">Tidak Tersedia</span>
                                </div>
                                <p class="text-red-700 text-sm">Buku sedang dipinjam semua</p>
                            </div>
                        @endif
                    </div>

                    <!-- Share Section -->
                    <div class="px-6 pb-6 border-t border-gray-200" x-data="{ copied: false }">
                        <h4 class="text-sm font-bold text-gray-900 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <circle cx="18" cy="5" r="3"/>
                                <circle cx="6" cy="12" r="3"/>
                                <circle cx="18" cy="19" r="3"/>
                                <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/>
                                <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
                            </svg>
                            Bagikan
                        </h4>
                        <div class="grid grid-cols-2 gap-2">
                            <a href="mailto:?subject={{ urlencode($book->title) }}&body={{ urlencode('Lihat buku ini: ' . url()->current()) }}" 
                               class="flex items-center justify-center px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                </svg>
                                Email
                            </a>
                            <button 
                                @click="navigator.clipboard.writeText('{{ url()->current() }}').then(() => { copied = true; setTimeout(() => copied = false, 2000); })"
                                class="flex items-center justify-center px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors relative"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                                </svg>
                                <span x-show="!copied">Copy Link</span>
                                <span x-show="copied" class="text-green-600">Tersalin!</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Book Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Book Title & Author -->
                <div class="bg-white rounded-xl shadow-md p-8">
                    <div class="mb-4">
                        <span class="inline-flex items-center px-3 py-1 bg-red-50 text-[#D32F2F] text-sm font-semibold rounded-full mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                            </svg>
                            {{ $book->category->name ?? 'Uncategorized' }}
                        </span>
                    </div>

                    <h1 class="text-4xl font-bold text-gray-900 mb-4 leading-tight">{{ $book->title }}</h1>
                    
                    <div class="flex items-center text-lg text-gray-600 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        oleh <strong class="ml-1 text-[#D32F2F]">{{ $book->author }}</strong>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <span class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 text-sm font-medium rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1.5">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            {{ $book->publication_year }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1.5 bg-purple-50 text-purple-700 text-sm font-medium rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1.5">
                                <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                            </svg>
                            ISBN: {{ $book->isbn }}
                        </span>
                    </div>
                </div>

                <!-- Book Details Table -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-[#D32F2F] to-[#B71C1C] px-6 py-4">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" y1="16" x2="12" y2="12"/>
                                <line x1="12" y1="8" x2="12.01" y2="8"/>
                            </svg>
                            Detail Buku
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">ISBN</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $book->isbn }}</p>
                                </div>
                            </div>

                            <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 3v18h18"/>
                                        <path d="m19 9-5 5-4-4-3 3"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Penerbit</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $book->publisher }}</p>
                                </div>
                            </div>

                            <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                        <line x1="16" y1="2" x2="16" y2="6"/>
                                        <line x1="8" y1="2" x2="8" y2="6"/>
                                        <line x1="3" y1="10" x2="21" y2="10"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Tahun Terbit</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $book->publication_year }}</p>
                                </div>
                            </div>

                            <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#8B5CF6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Kategori</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $book->category->name ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0 w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m5 8 6 6"/>
                                        <path d="m4 14 6-6 2-3"/>
                                        <path d="M2 5h12"/>
                                        <path d="M7 2h1"/>
                                        <path d="m22 22-5-10-5 10"/>
                                        <path d="M14 18h6"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Bahasa</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $book->language ?? 'Indonesia' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Jumlah Halaman</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $book->pages ?? '-' }} halaman</p>
                                </div>
                            </div>

                            <div class="flex items-start p-4 bg-gray-50 rounded-lg md:col-span-2">
                                <div class="flex-shrink-0 w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                                        <polyline points="3.29 7 12 12 20.71 7"/>
                                        <line x1="12" y1="22" x2="12" y2="12"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Stok Tersedia</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        <strong class="text-lg text-[#D32F2F]">{{ $book->stock }}</strong> dari {{ $book->total_stock ?? $book->stock }} buku
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                @if($book->description)
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-[#D32F2F] to-[#B71C1C] px-6 py-4">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                                <line x1="10" y1="9" x2="8" y2="9"/>
                            </svg>
                            Deskripsi
                        </h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 leading-relaxed">{{ $book->description }}</p>
                    </div>
                </div>
                @endif

                <!-- Borrowing Information -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl shadow-md overflow-hidden border border-blue-200">
                    <div class="px-6 py-4 bg-blue-100 border-b border-blue-200">
                        <h3 class="text-lg font-bold text-blue-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1E40AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" y1="16" x2="12" y2="12"/>
                                <line x1="12" y1="8" x2="12.01" y2="8"/>
                            </svg>
                            Informasi Peminjaman
                        </h3>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 mt-0.5 flex-shrink-0">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                                <span class="text-gray-700">Durasi peminjaman: <strong class="text-blue-900">14 hari</strong></span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 mt-0.5 flex-shrink-0">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                                <span class="text-gray-700">Denda keterlambatan: <strong class="text-blue-900">Rp 1.000/hari</strong></span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 mt-0.5 flex-shrink-0">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                                <span class="text-gray-700">Maksimal peminjaman: <strong class="text-blue-900">3 buku</strong></span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3 mt-0.5 flex-shrink-0">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                                <span class="text-gray-700">Perpanjangan: <strong class="text-blue-900">1 kali (7 hari)</strong></span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('peminjam.books.index') }}" 
                       class="flex-1 px-6 py-4 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 hover:border-[#D32F2F] hover:text-[#D32F2F] transition-all duration-200 flex items-center justify-center shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>
                        Kembali ke Katalog
                    </a>
                    
                    @if($book->stock > 0 && !$hasActiveBorrowing)
                        <form method="POST" action="{{ route('peminjam.borrow.store', $book->id) }}" class="flex-1" x-data="{ submitting: false }">
                            @csrf
                            <button 
                                type="submit" 
                                @click="if(!confirm('Yakin ingin meminjam buku ini?')) { $event.preventDefault(); } else { submitting = true; }"
                                :disabled="submitting"
                                class="w-full px-6 py-4 bg-gradient-to-r from-[#D32F2F] to-[#B71C1C] text-white font-bold rounded-lg hover:from-[#B71C1C] hover:to-[#D32F2F] transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                                </svg>
                                <span x-show="!submitting">Pinjam Sekarang</span>
                                <span x-show="submitting">Memproses...</span>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Similar Books Section -->
        @if(isset($similarBooks) && $similarBooks->count() > 0)
        <div class="bg-white rounded-xl shadow-md p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                </svg>
                Buku Sejenis
            </h3>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach($similarBooks as $similarBook)
                <div class="group bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="relative h-48 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                        @if($similarBook->cover)
                            <img 
                                src="{{ asset('storage/' . $similarBook->cover) }}" 
                                alt="{{ $similarBook->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                                </svg>
                            </div>
                        @endif

                        <div class="absolute top-2 right-2">
                            @if($similarBook->stock > 0)
                                <span class="px-2 py-1 bg-green-500 text-white text-xs font-bold rounded-full shadow-lg">Tersedia</span>
                            @else
                                <span class="px-2 py-1 bg-red-500 text-white text-xs font-bold rounded-full shadow-lg">Habis</span>
                            @endif
                        </div>
                    </div>

                    <div class="p-3">
                        <h4 class="font-semibold text-gray-900 text-sm mb-1 line-clamp-2 group-hover:text-[#D32F2F] transition-colors min-h-[2.5rem]">
                            {{ $similarBook->title }}
                        </h4>
                        <p class="text-xs text-gray-600 mb-3 truncate">{{ $similarBook->author }}</p>
                        
                        <a href="{{ route('peminjam.books.show', $similarBook->id) }}" 
                           class="block w-full text-center px-3 py-2 bg-gradient-to-r from-[#D32F2F] to-[#B71C1C] text-white text-xs font-semibold rounded-lg hover:from-[#B71C1C] hover:to-[#D32F2F] transition-all duration-200 transform hover:scale-105">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection