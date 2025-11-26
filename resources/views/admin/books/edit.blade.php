@extends('layouts.admin')

@section('title', 'Edit Buku')
@section('page-title', 'Edit Buku')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8 animate-fadeInUp">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Edit Buku</h1>
                    <p class="text-sm text-gray-500 mt-1">{{ $book->title }}</p>
                </div>
                <a href="{{ route('admin.books.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span class="hidden sm:inline">Kembali</span>
                </a>
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden animate-fadeInUp" style="animation-delay: 0.1s">
            <form method="POST" action="{{ route('admin.books.update', $book->id) }}" enctype="multipart/form-data" id="bookForm">
                @csrf
                @method('PUT')
                
                <div class="p-6 sm:p-8 space-y-6">
                    <!-- Informasi Dasar Section -->
                    <div class="animate-fadeInUp" style="animation-delay: 0.2s">
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Informasi Dasar
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Judul Buku -->
                            <div class="md:col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                    Judul Buku <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                    <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" 
                                        class="block w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all duration-200 @error('title') border-red-500 @enderror" 
                                        placeholder="Masukkan judul buku" required>
                                </div>
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Pengarang -->
                            <div>
                                <label for="author" class="block text-sm font-medium text-gray-700 mb-2">
                                    Pengarang <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" 
                                        class="block w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all duration-200 @error('author') border-red-500 @enderror" 
                                        placeholder="Nama pengarang" required>
                                </div>
                                @error('author')
                                    <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Penerbit -->
                            <div>
                                <label for="publisher" class="block text-sm font-medium text-gray-700 mb-2">
                                    Penerbit <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <input type="text" name="publisher" id="publisher" value="{{ old('publisher', $book->publisher) }}" 
                                        class="block w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all duration-200 @error('publisher') border-red-500 @enderror" 
                                        placeholder="Nama penerbit" required>
                                </div>
                                @error('publisher')
                                    <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- ISBN -->
                            <div>
                                <label for="isbn" class="block text-sm font-medium text-gray-700 mb-2">
                                    ISBN <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                        </svg>
                                    </div>
                                    <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}" 
                                        class="block w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all duration-200 @error('isbn') border-red-500 @enderror" 
                                        placeholder="978-xxx-xxx-xxx-x" required>
                                </div>
                                @error('isbn')
                                    <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Tahun Terbit -->
                            <div>
                                <label for="year" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tahun Terbit <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input type="number" name="year" id="year" value="{{ old('year', $book->year) }}" min="1900" max="{{ date('Y') }}" 
                                        class="block w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all duration-200 @error('year') border-red-500 @enderror" 
                                        placeholder="{{ date('Y') }}" required>
                                </div>
                                @error('year')
                                    <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-200"></div>

                    <!-- Klasifikasi Section -->
                    <div class="animate-fadeInUp" style="animation-delay: 0.3s">
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Klasifikasi & Lokasi
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Kategori -->
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                    </div>
                                    <select name="category_id" id="category_id" 
                                        class="block w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all duration-200 @error('category_id') border-red-500 @enderror" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Kode Rak -->
                            <div>
                                <label for="shelf_code" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kode Rak <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <input type="text" name="shelf_code" id="shelf_code" value="{{ old('shelf_code', $book->shelf_code) }}" 
                                        class="block w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all duration-200 @error('shelf_code') border-red-500 @enderror uppercase" 
                                        placeholder="Contoh: A-01, B-12" required>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Kode lokasi rak penyimpanan buku</p>
                                @error('shelf_code')
                                    <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Jumlah Stok -->
                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">
                                    Jumlah Stok <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <input type="number" name="stock" id="stock" value="{{ old('stock', $book->stock) }}" min="0" 
                                        class="block w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all duration-200 @error('stock') border-red-500 @enderror" 
                                        placeholder="0" required>
                                </div>
                                @error('stock')
                                    <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Jumlah Halaman -->
                            <div>
                                <label for="pages" class="block text-sm font-medium text-gray-700 mb-2">
                                    Jumlah Halaman
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <input type="number" name="pages" id="pages" value="{{ old('pages', $book->pages) }}" min="1" 
                                        class="block w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all duration-200 @error('pages') border-red-500 @enderror" 
                                        placeholder="0">
                                </div>
                                @error('pages')
                                    <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-200"></div>

                    <!-- Detail Tambahan Section -->
                    <div class="animate-fadeInUp" style="animation-delay: 0.4s">
                        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Detail Tambahan
                        </h2>

                        <!-- Deskripsi -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi
                            </label>
                            <textarea name="description" id="description" rows="5" 
                                class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all duration-200 @error('description') border-red-500 @enderror resize-none" 
                                placeholder="Tuliskan sinopsis atau deskripsi buku...">{{ old('description', $book->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Cover Buku -->
                        <div>
                            <label for="cover" class="block text-sm font-medium text-gray-700 mb-2">
                                Cover Buku
                            </label>
                            <div class="flex items-start gap-4">
                                <div class="flex-1">
                                    <!-- Current Cover Display -->
                                    @if($book->cover)
                                    <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                        <p class="text-xs font-medium text-gray-700 mb-2 flex items-center gap-1">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Cover saat ini
                                        </p>
                                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-32 h-44 object-cover rounded-lg border-2 border-gray-200 shadow-sm">
                                    </div>
                                    @endif

                                    <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-[#D32F2F] transition-all duration-200 cursor-pointer" id="dropZone">
                                        <input type="file" name="cover" id="cover" accept="image/*" class="hidden">
                                        <div id="uploadPrompt">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-600">
                                                <label for="cover" class="text-[#D32F2F] hover:text-[#B71C1C] font-medium cursor-pointer">Upload cover baru</label>
                                                atau drag & drop
                                            </p>
                                            <p class="mt-1 text-xs text-gray-500">JPG, PNG, JPEG (Max: 2MB)</p>
                                            @if($book->cover)
                                            <p class="mt-2 text-xs text-amber-600 flex items-center justify-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Kosongkan jika tidak ingin mengubah cover
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                    @error('cover')
                                        <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div id="previewContainer" class="hidden">
                                    <div class="relative group">
                                        <div class="mb-2">
                                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded-full">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                Preview Baru
                                            </span>
                                        </div>
                                        <img id="coverPreview" src="" alt="Preview" class="w-32 h-44 object-cover rounded-lg border-2 border-blue-300 shadow-sm">
                                        <button type="button" id="removePreview" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="bg-gray-50 px-6 sm:px-8 py-4 flex flex-col-reverse sm:flex-row items-center justify-end gap-3 border-t border-gray-200">
                    <a href="{{ route('admin.books.index') }}" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-6 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>
                    <button type="submit" id="submitBtn" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-6 py-2.5 bg-[#D32F2F] text-white rounded-lg hover:bg-[#B71C1C] transition-all duration-200 shadow-sm hover:shadow-md group">
                        <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <span id="submitText">Update Buku</span>
                        <svg class="w-5 h-5 animate-spin hidden" id="loadingSpinner" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <div class="p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="flex-shrink-0 w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Konfirmasi</h3>
                    <p class="text-sm text-gray-500 mt-1">Apakah Anda yakin ingin membatalkan?</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 mb-6">Perubahan yang sudah diisi akan hilang dan tidak dapat dikembalikan.</p>
            <div class="flex gap-3">
                <button type="button" id="cancelModal" class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200">
                    Tidak
                </button>
                <a href="{{ route('admin.books.index') }}" class="flex-1 px-4 py-2.5 bg-[#D32F2F] text-white rounded-lg hover:bg-[#B71C1C] transition-all duration-200 text-center">
                    Ya, Batalkan
                </a>
            </div>
        </div>
    </div>
</div>

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

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }

    #dropZone.drag-over {
        border-color: #D32F2F;
        background-color: #FEF2F2;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('bookForm');
    const coverInput = document.getElementById('cover');
    const dropZone = document.getElementById('dropZone');
    const uploadPrompt = document.getElementById('uploadPrompt');
    const previewContainer = document.getElementById('previewContainer');
    const coverPreview = document.getElementById('coverPreview');
    const removePreview = document.getElementById('removePreview');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const shelfCodeInput = document.getElementById('shelf_code');
    const confirmModal = document.getElementById('confirmModal');
    const modalContent = document.getElementById('modalContent');
    const cancelModal = document.getElementById('cancelModal');

    // Store original form values
    const originalValues = {};
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        if (input.type !== 'file' && input.name) {
            originalValues[input.name] = input.value;
        }
    });

    // Auto uppercase untuk shelf code
    if (shelfCodeInput) {
        shelfCodeInput.addEventListener('input', function(e) {
            this.value = this.value.toUpperCase();
        });
    }

    // Preview image
    function previewImage(file) {
        if (file && file.type.startsWith('image/')) {
            // Validasi ukuran file (2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 2MB.');
                coverInput.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                coverPreview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    // Cover input change
    if (coverInput) {
        coverInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                previewImage(file);
            }
        });
    }

    // Remove preview
    if (removePreview) {
        removePreview.addEventListener('click', function() {
            coverInput.value = '';
            coverPreview.src = '';
            previewContainer.classList.add('hidden');
        });
    }

    // Drag and drop
    if (dropZone) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.add('drag-over');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.remove('drag-over');
            }, false);
        });

        dropZone.addEventListener('drop', function(e) {
            const dt = e.dataTransfer;
            const file = dt.files[0];
            
            if (file && file.type.startsWith('image/')) {
                coverInput.files = dt.files;
                previewImage(file);
            } else {
                alert('Hanya file gambar yang diperbolehkan.');
            }
        });

        dropZone.addEventListener('click', function() {
            coverInput.click();
        });
    }

    // Form validation
    const requiredInputs = form.querySelectorAll('[required]');
    requiredInputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (!this.value.trim()) {
                this.classList.add('border-red-500');
            } else {
                this.classList.remove('border-red-500');
            }
        });

        input.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('border-red-500');
            }
        });
    });

    // Form submit
    form.addEventListener('submit', function(e) {
        let isValid = true;
        let firstError = null;

        requiredInputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('border-red-500');
                isValid = false;
                if (!firstError) {
                    firstError = input;
                }
            }
        });

        if (!isValid) {
            e.preventDefault();
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
            return;
        }

        // Show loading state
        submitBtn.disabled = true;
        submitText.textContent = 'Mengupdate...';
        loadingSpinner.classList.remove('hidden');
    });

    // Check if form has been modified
    function isFormModified() {
        let isModified = false;
        
        inputs.forEach(input => {
            if (input.type === 'file' && input.files.length > 0) {
                isModified = true;
            } else if (input.name && originalValues[input.name] !== undefined) {
                if (input.value !== originalValues[input.name]) {
                    isModified = true;
                }
            }
        });
        
        return isModified;
    }

    // Cancel confirmation with modal
    const cancelBtns = document.querySelectorAll('a[href="{{ route('admin.books.index') }}"]');
    cancelBtns.forEach(btn => {
        if (!btn.closest('#confirmModal')) {
            btn.addEventListener('click', function(e) {
                if (isFormModified()) {
                    e.preventDefault();
                    showModal();
                }
            });
        }
    });

    function showModal() {
        confirmModal.classList.remove('hidden');
        confirmModal.classList.add('flex');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function hideModal() {
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            confirmModal.classList.add('hidden');
            confirmModal.classList.remove('flex');
        }, 300);
    }

    if (cancelModal) {
        cancelModal.addEventListener('click', hideModal);
    }

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !confirmModal.classList.contains('hidden')) {
            hideModal();
        }
    });

    // Close modal when clicking outside
    confirmModal.addEventListener('click', function(e) {
        if (e.target === confirmModal) {
            hideModal();
        }
    });

    // Auto-format ISBN
    const isbnInput = document.getElementById('isbn');
    if (isbnInput) {
        isbnInput.addEventListener('blur', function() {
            let value = this.value.replace(/[^0-9]/g, '');
            if (value.length === 13) {
                this.value = value.slice(0, 3) + '-' + value.slice(3, 6) + '-' + value.slice(6, 9) + '-' + value.slice(9, 12) + '-' + value.slice(12);
            }
        });
    }
});
</script>
@endpush
@endsection