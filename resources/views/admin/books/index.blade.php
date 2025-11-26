@extends('layouts.admin')

@section('title', 'Kelola Buku')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Buku</h1>
            <p class="text-sm text-gray-500 mt-1">Manage semua koleksi buku perpustakaan</p>
        </div>
        <a href="{{ route('admin.books.create') }}" 
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#D32F2F] text-white rounded-lg hover:bg-[#B71C1C] transition-all duration-200 shadow-sm hover:shadow-md group">
            <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span class="font-medium">Tambah Buku</span>
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Total Buku</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $books->total() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Tersedia</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $books->where('stock', '>', 0)->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-amber-50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Dipinjam</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $books->where('stock', '=', 0)->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Kategori</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $categories->count() ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
        <form method="GET" action="{{ route('admin.books.index') }}" class="flex flex-col lg:flex-row gap-3">
            <!-- Search Input -->
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari judul, pengarang, atau ISBN..." 
                    value="{{ request('search') }}"
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all">
            </div>

            <!-- Category Filter -->
            <div class="relative w-full lg:w-48">
                <select name="category" 
                        class="appearance-none w-full pl-4 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all bg-white">
                    <option value="">Semua Kategori</option>
                    @foreach($categories ?? [] as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>

            <!-- Status Filter -->
            <div class="relative w-full lg:w-40">
                <select name="status" 
                        class="appearance-none w-full pl-4 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all bg-white">
                    <option value="">Semua Status</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
                </select>
                <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-2">
                <button type="submit" 
                        class="px-4 py-2.5 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-all font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter
                </button>
                <a href="{{ route('admin.books.index') }}" 
                   class="px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse($books as $book)
    <div class="book-card bg-white rounded-xl shadow-lg border border-gray-200 transform hover:shadow-xl hover:border-red-600 hover:-translate-y-1 transition-all duration-300 group overflow-hidden">
        
        <div class="relative h-64 bg-gradient-to-br from-red-50 to-red-100 overflow-hidden">
            @if($book->image)
                <img src="{{ asset('storage/' . $book->image) }}" 
                     alt="{{ $book->title }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300 ease-in-out">
            @else
                <div class="w-full h-full flex flex-col items-center justify-center text-red-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open-text mb-2">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                        <path d="M6 8h2"/><path d="M6 12h2"/><path d="M16 8h2"/><path d="M16 12h2"/>
                    </svg>
                    <p class="text-sm font-semibold text-red-500">Tanpa Sampul</p>
                </div>
            @endif
            
            <div class="absolute top-4 right-4">
                <span class="px-3 py-1 text-xs font-bold rounded-full shadow-md
                    {{ $book->stock > 0 ? 'bg-green-500 text-white' : 'bg-red-600 text-white' }}">
                    {{ $book->stock > 0 ? 'TERSEDIA' : 'HABIS' }}
                </span>
            </div>

            @if($book->stock > 0)
            <div class="absolute top-4 left-4">
                <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-xs font-semibold shadow-md text-gray-700">
                    Stok: {{ $book->stock }}
                </span>
            </div>
            @endif
        </div>

        <div class="p-5">
            <div class="mb-4">
                @if($book->category)
@php
    // Logika penentuan ikon dan warna berdasarkan nama kategori
    $categoryName = strtolower($book->category->name);
    $icon = 'tag'; // Default icon
    $color = 'gray'; // Default color (Ganti menjadi 'red' jika Anda ingin defaultnya merah)
    
    if (str_contains($categoryName, 'fiksi') || str_contains($categoryName, 'novel')) {
        $icon = 'feather';
        $color = 'red';
    } elseif (str_contains($categoryName, 'sains') || str_contains($categoryName, 'teknologi')) {
        $icon = 'atom';
        $color = 'blue';
    } elseif (str_contains($categoryName, 'sejarah') || str_contains($categoryName, 'budaya')) {
        $icon = 'clock';
        $color = 'amber';
    } elseif (str_contains($categoryName, 'bisnis') || str_contains($categoryName, 'ekonomi')) {
        $icon = 'dollar-sign';
        $color = 'green';
    }
@endphp

<span class="inline-flex items-center gap-1.5 px-3 py-1 
      bg-{{ $color }}-100 text-{{ $color }}-700 rounded-full text-xs font-semibold mb-2 shadow-sm 
      transition-colors duration-300 group-hover:bg-{{ $color }}-200">
    
    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-{{ $icon }}">
        @switch($icon)
            @case('feather')
                <path d="M20.24 12.24a4 4 0 0 0-5.66-5.66L9 11.41V2l-3 3 3 3-5.5 5.5a4 4 0 0 0 0 5.66L15 22l5.24-5.24a4 4 0 0 0 0-5.66z"/>
                @break
            @case('atom')
                <circle cx="12" cy="12" r="3"/><path d="M12 2v20"/><path d="m4.93 4.93 2.83 2.83"/><path d="M2 12h20"/><path d="m4.93 19.07 2.83-2.83"/><path d="m19.07 4.93-2.83 2.83"/><path d="m19.07 19.07-2.83-2.83"/>
                @break
            @case('clock')
                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                @break
            @case('dollar-sign')
                <line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                @break
            @default
                <path d="M12 2v20"/><path d="m19 17-7-7-9 9m9 4V8"/>
        @endswitch
    </svg>
    {{ $book->category->name }}
</span>
@endif

                <h3 class="font-extrabold text-xl text-gray-900 line-clamp-2 leading-snug mb-1 group-hover:text-red-700 transition-colors duration-300">
                    {{ $book->title }}
                </h3>

                <p class="text-sm text-gray-600 flex items-center gap-1.5 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-album-icon lucide-album"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><polyline points="11 3 11 11 14 8 17 11 17 3"/></svg>
                    {{ $book->author }}
                </p>

                <p class="text-xs text-gray-500 flex items-center gap-1.5 font-mono">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-library-icon lucide-library"><path d="m16 6 4 14"/><path d="M12 6v14"/><path d="M8 8v12"/><path d="M4 4v16"/></svg>
                    {{ $book->isbn }}
                </p>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.books.show', $book->id) }}" 
                    class="flex-1 inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 hover:shadow-md transition-all duration-300 text-sm font-medium group/btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye group-hover/btn:scale-105 transition-transform duration-200">
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                    Detail
                </a>
                
                <a href="{{ route('admin.books.edit', $book->id) }}" 
                    class="flex-1 inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200 hover:shadow-md transition-all duration-300 text-sm font-medium group/btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil group-hover/btn:scale-105 transition-transform duration-200">
                        <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                    </svg>
                    Edit
                </a>
                
                <button onclick="confirmDelete('{{ $book->id }}', '{{ $book->title }}')" 
                        class="px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 hover:shadow-md transition-all duration-300 group/btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 group-hover/btn:scale-105 transition-transform duration-200">
                        <path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M14 6V4c0-1-1-2-2-2h-4c-1 0-2 1-2 2v2"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <form id="delete-form-{{ $book->id }}" 
            method="POST" 
            action="{{ route('admin.books.destroy', $book->id) }}" 
            class="hidden">
        @csrf
        @method('DELETE')
    </form>
    @empty
    <div class="col-span-full bg-white rounded-xl shadow-xl border border-gray-200 p-16 text-center">
        <div class="inline-flex items-center justify-center w-24 h-24 bg-red-50 rounded-full mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open-text text-red-400">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Tidak Ada Buku Ditemukan</h3>
        <p class="text-gray-500 mb-6">Saat ini, belum ada data buku yang tersedia. Mari mulai menambahkannya!</p>
        <a href="{{ route('admin.books.create') }}" 
           class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 text-white rounded-xl font-semibold shadow-lg hover:bg-red-700 hover:shadow-xl transform transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                <path d="M12 5v14"/><path d="M5 12h14"/>
            </svg>
            Tambah Buku Pertama
        </a>
    </div>
    @endforelse
</div>

    <!-- Pagination -->
    @if($books->hasPages())
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 px-4 py-3">
        {{ $books->links() }}
    </div>
    @endif
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
                    <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h3>
                    <p class="text-sm text-gray-500 mt-1">Apakah Anda yakin ingin menghapus buku ini?</p>
                </div>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-3 mb-4">
                <p class="text-sm text-gray-600">Buku: <span class="font-semibold text-gray-900" id="deleteBookTitle"></span></p>
            </div>

            <p class="text-sm text-gray-500 mb-6">Tindakan ini tidak dapat dibatalkan. Semua data yang terkait dengan buku ini akan dihapus.</p>

            <div class="flex gap-3">
                <button onclick="closeDeleteModal()" 
                        class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all font-medium">
                    Batal
                </button>
                <button onclick="submitDelete()" 
                        class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all font-medium">
                    Ya, Hapus
                </button>
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

    .book-card {
        animation: slideUp 0.3s ease-out;
    }

    .book-card:nth-child(1) { animation-delay: 0.05s; }
    .book-card:nth-child(2) { animation-delay: 0.1s; }
    .book-card:nth-child(3) { animation-delay: 0.15s; }
    .book-card:nth-child(4) { animation-delay: 0.2s; }
    .book-card:nth-child(5) { animation-delay: 0.25s; }
    .book-card:nth-child(6) { animation-delay: 0.3s; }
    .book-card:nth-child(7) { animation-delay: 0.35s; }
    .book-card:nth-child(8) { animation-delay: 0.4s; }

    #deleteModal.show {
        display: flex !important;
    }

    #deleteModal.show #modalContent {
        opacity: 1;
        transform: scale(1);
    }
</style>

<script>
    let currentDeleteBookId = null;

    function confirmDelete(bookId, bookTitle) {
        currentDeleteBookId = bookId;
        document.getElementById('deleteBookTitle').textContent = bookTitle;
        
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
            currentDeleteBookId = null;
        }, 200);
    }

    function submitDelete() {
        if (currentDeleteBookId) {
            document.getElementById('delete-form-' + currentDeleteBookId).submit();
        }
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
</script>
@endsection