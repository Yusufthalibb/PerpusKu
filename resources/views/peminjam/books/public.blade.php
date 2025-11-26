@extends('layouts.app')

@section('title', 'Katalog Buku Publik')

@section('content')
<div class="public-catalog-container">
    <!-- Hero Section -->
    <div class="catalog-hero">
        <h1>Katalog Buku Perpustakaan</h1>
        <p>Jelajahi koleksi buku kami. Login untuk meminjam buku favorit Anda!</p>
        @guest
            <div class="hero-actions">
                <a href="{{ route('login') }}" class="btn btn-primary">Login untuk Meminjam</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Daftar Sekarang</a>
            </div>
        @endguest
    </div>

    <!-- Search & Filter -->
    <div class="search-section">
        <form method="GET" action="{{ route('books.public') }}">
            <div class="search-box">
                <input type="text" name="search" placeholder="Cari judul, pengarang, atau ISBN..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">🔍 Cari</button>
            </div>

            <div class="filter-row">
                <select name="category">
                    <option value="">Semua Kategori</option>
                    @foreach($categories ?? [] as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <select name="sort">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Judul (A-Z)</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Populer</option>
                </select>

                <button type="submit" class="btn btn-secondary">Filter</button>
                <a href="{{ route('books.public') }}" class="btn btn-link">Reset</a>
            </div>
        </form>
    </div>

    <!-- Categories Quick Filter -->
    <div class="categories-filter">
        <h3>Kategori Populer</h3>
        <div class="category-tags">
            <a href="{{ route('books.public') }}" class="category-tag {{ !request('category') ? 'active' : '' }}">
                Semua
            </a>
            @foreach($popularCategories ?? [] as $category)
                <a href="{{ route('books.public', ['category' => $category->id]) }}" 
                   class="category-tag {{ request('category') == $category->id ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Results -->
    <div class="results-info">
        <p>Menampilkan <strong>{{ $books->total() }}</strong> buku</p>
    </div>

    <!-- Books Grid -->
    <div class="books-grid">
        @forelse($books as $book)
        <div class="book-card">
            <div class="book-cover">
                @if($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}">
                @else
                    <div class="book-placeholder">
                        <span>📖</span>
                    </div>
                @endif
                <div class="book-badge">
                    @if($book->stock > 0)
                        <span class="badge badge-success">Tersedia</span>
                    @else
                        <span class="badge badge-danger">Habis</span>
                    @endif
                </div>
            </div>
            
            <div class="book-info">
                <h3>{{ $book->title }}</h3>
                <p class="author">{{ $book->author }}</p>
                <p class="category">{{ $book->category->name ?? '-' }}</p>
                
                <div class="book-meta">
                    <small>📅 {{ $book->publication_year }}</small>
                    <small>📦 Stok: {{ $book->stock }}</small>
                </div>

                @auth
                    <a href="{{ route('peminjam.books.show', $book->id) }}" class="btn btn-primary btn-block">
                        Lihat Detail
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-secondary btn-block">
                        Login untuk Meminjam
                    </a>
                @endauth
            </div>
        </div>
        @empty
        <div class="empty-state">
            <h3>Tidak ada buku ditemukan</h3>
            <p>Coba kata kunci lain atau ubah filter pencarian</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $books->links() }}
    </div>

    <!-- CTA Section -->
    @guest
    <div class="cta-section">
        <h2>Ingin Meminjam Buku?</h2>
        <p>Daftar sekarang dan nikmati akses ke ribuan koleksi buku kami</p>
        <div class="cta-buttons">
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Daftar Gratis</a>
            <a href="{{ route('login') }}" class="btn btn-secondary btn-lg">Sudah Punya Akun?</a>
        </div>
    </div>
    @endguest
</div>

@push('scripts')
<script>
    // Auto submit on select change
    document.querySelectorAll('select[name="category"], select[name="sort"]').forEach(function(select) {
        select.addEventListener('change', function() {
            this.form.submit();
        });
    });
</script>
@endpush
@endsection