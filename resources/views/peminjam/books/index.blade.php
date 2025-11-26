@extends('layouts.peminjam')
@section('title', 'Katalog Buku')
@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Page Header with Breadcrumb -->
    <div class="bg-gradient-to-r from-[#D32F2F] to-[#B71C1C] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Breadcrumb -->
            <nav class="flex mb-4 text-sm" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('peminjam.dashboard') }}" class="text-red-100 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-200">
                                <polyline points="9 18 15 12 9 6"/>
                            </svg>
                            <span class="ml-2 text-white font-medium">Katalog Buku</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Header Content -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                        </svg>
                        Katalog Buku Perpustakaan
                    </h1>
                    <p class="text-red-100 text-lg">Temukan buku favorit Anda dari koleksi kami</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search & Filter Section -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8" x-data="{ showFilters: false }">
            <form method="GET" action="{{ route('peminjam.books.index') }}" class="space-y-4">
                <!-- Search Bar -->
                <div class="flex flex-col md:flex-row gap-3">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"/>
                                <path d="m21 21-4.3-4.3"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Cari judul buku, pengarang, atau ISBN..." 
                            value="{{ request('search') }}"
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all duration-200"
                        >
                    </div>
                    <button 
                        type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-[#D32F2F] to-[#B71C1C] text-white font-semibold rounded-lg hover:from-[#B71C1C] hover:to-[#D32F2F] transition-all duration-200 flex items-center justify-center shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.3-4.3"/>
                        </svg>
                        Cari
                    </button>
                    <button 
                        type="button"
                        @click="showFilters = !showFilters"
                        class="px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:border-[#D32F2F] hover:text-[#D32F2F] transition-all duration-200 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                        </svg>
                        Filter
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2 transition-transform duration-200" :class="showFilters ? 'rotate-180' : ''">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </button>
                </div>

                <!-- Advanced Filters (Collapsible) -->
                <div 
                    x-show="showFilters" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                    class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 border-t border-gray-200"
                >
                    <!-- Category Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                            </svg>
                            Kategori
                        </label>
                        <select 
                            name="category"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all duration-200"
                            onchange="this.form.submit()"
                        >
                            <option value="">Semua Kategori</option>
                            @foreach($categories ?? [] as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Availability Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            Ketersediaan
                        </label>
                        <select 
                            name="availability"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all duration-200"
                            onchange="this.form.submit()"
                        >
                            <option value="">Semua Buku</option>
                            <option value="available" {{ request('availability') == 'available' ? 'selected' : '' }}>Tersedia</option>
                            <option value="borrowed" {{ request('availability') == 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
                        </select>
                    </div>

                    <!-- Sort Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <path d="m3 16 4 4 4-4"/>
                                <path d="M7 20V4"/>
                                <path d="m21 8-4-4-4 4"/>
                                <path d="M17 4v16"/>
                            </svg>
                            Urutkan
                        </label>
                        <select 
                            name="sort"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all duration-200"
                            onchange="this.form.submit()"
                        >
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Judul (A-Z)</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Paling Populer</option>
                        </select>
                    </div>
                </div>

                <!-- Active Filters & Reset -->
                @if(request('search') || request('category') || request('availability') || request('sort'))
                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <div class="flex flex-wrap gap-2">
                        <span class="text-sm text-gray-600 font-medium">Filter Aktif:</span>
                        @if(request('search'))
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-[#D32F2F]">
                                Pencarian: "{{ request('search') }}"
                                <a href="{{ route('peminjam.books.index', array_merge(request()->except('search'))) }}" class="ml-2 hover:text-[#B71C1C]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"/>
                                        <line x1="6" y1="6" x2="18" y2="18"/>
                                    </svg>
                                </a>
                            </span>
                        @endif
                        @if(request('category'))
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Kategori
                                <a href="{{ route('peminjam.books.index', array_merge(request()->except('category'))) }}" class="ml-2 hover:text-blue-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"/>
                                        <line x1="6" y1="6" x2="18" y2="18"/>
                                    </svg>
                                </a>
                            </span>
                        @endif
                        @if(request('availability'))
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                {{ request('availability') == 'available' ? 'Tersedia' : 'Dipinjam' }}
                                <a href="{{ route('peminjam.books.index', array_merge(request()->except('availability'))) }}" class="ml-2 hover:text-green-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"/>
                                        <line x1="6" y1="6" x2="18" y2="18"/>
                                    </svg>
                                </a>
                            </span>
                        @endif
                    </div>
                    <a href="{{ route('peminjam.books.index') }}" class="text-sm text-[#D32F2F] hover:text-[#B71C1C] font-medium flex items-center transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                            <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/>
                            <path d="M21 3v5h-5"/>
                            <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/>
                            <path d="M8 16H3v5"/>
                        </svg>
                        Reset Semua Filter
                    </a>
                </div>
                @endif
            </form>
        </div>

        <!-- Results Info & View Toggle -->
        <div class="flex items-center justify-between mb-6" x-data="{ viewMode: 'grid' }">
            <div class="flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                </svg>
                <p class="text-gray-700">
                    Menampilkan <strong class="text-[#D32F2F] font-bold">{{ $books->total() }}</strong> buku
                    @if(request('search'))
                        untuk "<strong>{{ request('search') }}</strong>"
                    @endif
                </p>
            </div>

            <!-- View Mode Toggle -->
            <div class="flex items-center bg-gray-100 rounded-lg p-1">
                <button 
                    @click="viewMode = 'grid'"
                    :class="viewMode === 'grid' ? 'bg-white shadow-sm' : 'bg-transparent'"
                    class="px-3 py-2 rounded-md transition-all duration-200"
                    title="Grid View"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" :stroke="viewMode === 'grid' ? '#D32F2F' : '#6B7280'" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                    </svg>
                </button>
                <button 
                    @click="viewMode = 'list'"
                    :class="viewMode === 'list' ? 'bg-white shadow-sm' : 'bg-transparent'"
                    class="px-3 py-2 rounded-md transition-all duration-200"
                    title="List View"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" :stroke="viewMode === 'list' ? '#D32F2F' : '#6B7280'" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="8" y1="6" x2="21" y2="6"/>
                        <line x1="8" y1="12" x2="21" y2="12"/>
                        <line x1="8" y1="18" x2="21" y2="18"/>
                        <line x1="3" y1="6" x2="3.01" y2="6"/>
                        <line x1="3" y1="12" x2="3.01" y2="12"/>
                        <line x1="3" y1="18" x2="3.01" y2="18"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Books Display -->
        <div x-data="{ viewMode: 'grid' }">
            <!-- Grid View -->
            <div 
                x-show="viewMode === 'grid'"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8"
            >
                @forelse($books as $book)
                <div class="group bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
                    <!-- Book Cover -->
                    <div class="relative h-72 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                        @if($book->image && file_exists(public_path('storage/' . $book->image)))
                            <img 
                                src="{{ asset('storage/' . $book->image) }}" 
                                alt="{{ $book->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                                </svg>
                            </div>
                        @endif

                        <!-- Stock Badge Overlay -->
                        <div class="absolute top-3 right-3">
                            @if($book->stock <= 0)
                                <span class="px-3 py-1.5 bg-red-500 text-white text-xs font-bold rounded-full shadow-lg flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="15" y1="9" x2="9" y2="15"/>
                                        <line x1="9" y1="9" x2="15" y2="15"/>
                                    </svg>
                                    Habis
                                </span>
                            @elseif($book->stock <= 3)
                                <span class="px-3 py-1.5 bg-orange-500 text-white text-xs font-bold rounded-full shadow-lg flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                        <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                                        <line x1="12" y1="9" x2="12" y2="13"/>
                                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                                    </svg>
                                    Terbatas
                                </span>
                            @else
                                <span class="px-3 py-1.5 bg-green-500 text-white text-xs font-bold rounded-full shadow-lg flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                    Tersedia
                                </span>
                            @endif
                        </div>

                        <!-- Quick View Overlay -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <a href="{{ route('peminjam.books.show', $book->id) }}" class="px-4 py-2 bg-white text-[#D32F2F] font-semibold rounded-lg transform scale-75 group-hover:scale-100 transition-all duration-300 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                Lihat Detail
                            </a>
                        </div>
                    </div>

                    <!-- Book Info -->
                    <div class="p-5">
                        <!-- Category Badge -->
                        <span class="inline-block px-2.5 py-1 bg-red-50 text-[#D32F2F] text-xs font-semibold rounded-full mb-3">
                            {{ $book->category->name ?? 'Uncategorized' }}
                        </span>

                        <!-- Title -->
                        <h3 class="font-bold text-gray-900 text-lg mb-2 line-clamp-2 group-hover:text-[#D32F2F] transition-colors min-h-[3.5rem]">
                            {{ $book->title }}
                        </h3>

                        <!-- Author -->
                        <p class="text-sm text-gray-600 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1.5">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                            {{ $book->author }}
                        </p>

                        <!-- Meta Info -->
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-4 pb-4 border-b border-gray-100">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                {{ $book->publication_year }}
                            </span>
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                    <path d="M3 3v18h18"/>
                                    <path d="m19 9-5 5-4-4-3 3"/>
                                </svg>
                                {{ $book->publisher }}
                            </span>
                        </div>

                        <!-- Stock Info -->
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-medium text-gray-700">Stok:</span>
                            @if($book->stock > 0)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                        <path d="M20 6 9 17l-5-5"/>
                                    </svg>
                                    {{ $book->stock }} Tersedia
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="15" y1="9" x2="9" y2="15"/>
                                        <line x1="9" y1="9" x2="15" y2="15"/>
                                    </svg>
                                    Tidak Tersedia
                                </span>
                            @endif
                        </div>

                        <!-- Action Button -->
                        <a href="{{ route('peminjam.books.show', $book->id) }}" 
                           class="block w-full text-center px-4 py-3 bg-gradient-to-r from-[#D32F2F] to-[#B71C1C] text-white font-semibold rounded-lg hover:from-[#B71C1C] hover:to-[#D32F2F] transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @empty
                <!-- Empty State -->
                <div class="col-span-full">
                    <div class="text-center py-16 bg-white rounded-xl shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#D1D5DB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-6">
                            <path d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.57a2 2 0 0 1-2.83-2.83l8.49-8.48"/>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak ada buku ditemukan</h3>
                        <p class="text-gray-600 mb-6">Coba ubah filter atau kata kunci pencarian Anda</p>
                        <a href="{{ route('peminjam.books.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#D32F2F] to-[#B71C1C] text-white font-semibold rounded-lg hover:from-[#B71C1C] hover:to-[#D32F2F] transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                            </svg>
                            Lihat Semua Buku
                        </a>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- List View -->
            <div 
                x-show="viewMode === 'list'"
                class="space-y-4 mb-8"
            >
                @forelse($books as $book)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="flex flex-col md:flex-row">
                        <!-- Book Cover -->
                        <div class="md:w-48 h-64 md:h-auto bg-gradient-to-br from-gray-100 to-gray-200 flex-shrink-0 relative overflow-hidden group">
                            @if($book->image && file_exists(public_path('storage/' . $book->image)))
                                <img 
                                    src="{{ asset('storage/' . $book->image) }}" 
                                    alt="{{ $book->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                                    </svg>
                                </div>
                            @endif

                            <!-- Stock Badge -->
                            <div class="absolute top-3 left-3">
                                @if($book->stock <= 0)
                                    <span class="px-2.5 py-1 bg-red-500 text-white text-xs font-bold rounded-full shadow-lg">Habis</span>
                                @elseif($book->stock <= 3)
                                    <span class="px-2.5 py-1 bg-orange-500 text-white text-xs font-bold rounded-full shadow-lg">Terbatas</span>
                                @else
                                    <span class="px-2.5 py-1 bg-green-500 text-white text-xs font-bold rounded-full shadow-lg">Tersedia</span>
                                @endif
                            </div>
                        </div>

                        <!-- Book Details -->
                        <div class="flex-1 p-6">
                            <div class="flex flex-col h-full">
                                <!-- Header -->
                                <div class="flex-1">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex-1">
                                            <span class="inline-block px-2.5 py-1 bg-red-50 text-[#D32F2F] text-xs font-semibold rounded-full mb-2">
                                                {{ $book->category->name ?? 'Uncategorized' }}
                                            </span>
                                            <h3 class="text-2xl font-bold text-gray-900 mb-2 hover:text-[#D32F2F] transition-colors">
                                                {{ $book->title }}
                                            </h3>
                                            <p class="text-gray-600 flex items-center mb-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                                    <circle cx="9" cy="7" r="4"/>
                                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                                </svg>
                                                {{ $book->author }}
                                            </p>
                                        </div>
                                        
                                        @if($book->stock > 0)
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold bg-green-100 text-green-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                                    <path d="M20 6 9 17l-5-5"/>
                                                </svg>
                                                {{ $book->stock }} Tersedia
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold bg-red-100 text-red-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                                                    <circle cx="12" cy="12" r="10"/>
                                                    <line x1="15" y1="9" x2="9" y2="15"/>
                                                    <line x1="9" y1="9" x2="15" y2="15"/>
                                                </svg>
                                                Tidak Tersedia
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Meta Information -->
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                                <line x1="16" y1="2" x2="16" y2="6"/>
                                                <line x1="8" y1="2" x2="8" y2="6"/>
                                                <line x1="3" y1="10" x2="21" y2="10"/>
                                            </svg>
                                            <span><strong>Tahun:</strong> {{ $book->publication_year }}</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D32F2F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                                <path d="M3 3v18h18"/>
                                                <path d="m19 9-5 5-4-4-3 3"/>
                                            </svg>
                                            <span><strong>Penerbit:</strong> {{ $book->publisher }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <div class="mt-4">
                                    <a href="{{ route('peminjam.books.show', $book->id) }}" 
                                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#D32F2F] to-[#B71C1C] text-white font-semibold rounded-lg hover:from-[#B71C1C] hover:to-[#D32F2F] transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Empty State -->
                <div class="text-center py-16 bg-white rounded-xl shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#D1D5DB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-6">
                        <path d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.57a2 2 0 0 1-2.83-2.83l8.49-8.48"/>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak ada buku ditemukan</h3>
                    <p class="text-gray-600 mb-6">Coba ubah filter atau kata kunci pencarian Anda</p>
                    <a href="{{ route('peminjam.books.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#D32F2F] to-[#B71C1C] text-white font-semibold rounded-lg hover:from-[#B71C1C] hover:to-[#D32F2F] transition-all duration-200 shadow-md hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                        </svg>
                        Lihat Semua Buku
                    </a>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        @if($books->hasPages())
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex flex-col sm:flex-row items-center justify-between">
                <div class="text-sm text-gray-600 mb-4 sm:mb-0">
                    Menampilkan 
                    <span class="font-semibold text-gray-900">{{ $books->firstItem() }}</span>
                    sampai
                    <span class="font-semibold text-gray-900">{{ $books->lastItem() }}</span>
                    dari
                    <span class="font-semibold text-gray-900">{{ $books->total() }}</span>
                    hasil
                </div>
                
                <div class="flex items-center space-x-2">
                    {{-- Previous Page Link --}}
                    @if ($books->onFirstPage())
                        <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"/>
                            </svg>
                        </span>
                    @else
                        <a href="{{ $books->previousPageUrl() }}" class="px-4 py-2 text-[#D32F2F] bg-white border-2 border-gray-300 rounded-lg hover:bg-red-50 hover:border-[#D32F2F] transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"/>
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    <div class="hidden sm:flex space-x-2">
                        @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                            @if ($page == $books->currentPage())
                                <span class="px-4 py-2 bg-gradient-to-r from-[#D32F2F] to-[#B71C1C] text-white font-semibold rounded-lg shadow-md">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="px-4 py-2 text-gray-700 bg-white border-2 border-gray-300 rounded-lg hover:bg-red-50 hover:border-[#D32F2F] hover:text-[#D32F2F] transition-all duration-200">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    </div>

                    {{-- Next Page Link --}}
                    @if ($books->hasMorePages())
                        <a href="{{ $books->nextPageUrl() }}" class="px-4 py-2 text-[#D32F2F] bg-white border-2 border-gray-300 rounded-lg hover:bg-red-50 hover:border-[#D32F2F] transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"/>
                            </svg>
                        </a>
                    @else
                        <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"/>
                            </svg>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection