@extends('layouts.admin')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tambah Pengguna Baru</h1>
            <p class="text-sm text-gray-500 mt-1">Lengkapi form di bawah untuk menambahkan pengguna</p>
        </div>
        <a href="{{ route('admin.users.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 group">
            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span class="font-medium">Kembali</span>
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data" id="userForm">
            @csrf
            
            <!-- Photo Upload Section -->
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-6 border-b border-gray-200">
                <div class="flex flex-col items-center">
                    <div class="relative group">
                        <div id="imagePreviewContainer" class="w-32 h-32 rounded-full bg-gradient-to-br from-[#D32F2F] to-[#B71C1C] flex items-center justify-center text-white text-4xl font-bold shadow-lg ring-4 ring-white transition-all group-hover:scale-105">
                            <span id="initialsPlaceholder">?</span>
                            <img id="imagePreview" class="hidden w-full h-full rounded-full object-cover" alt="Preview">
                        </div>
                        <label for="image" class="absolute bottom-0 right-0 w-10 h-10 bg-[#D32F2F] rounded-full flex items-center justify-center cursor-pointer shadow-lg hover:bg-[#B71C1C] transition-all group-hover:scale-110">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </label>
                    </div>
                    <input type="file" name="image" id="image" accept="image/*" class="hidden">
                    <p class="text-sm text-gray-600 mt-3">Upload Foto Profil</p>
                    <p class="text-xs text-gray-500 mt-1">JPG, PNG, JPEG (Max: 2MB)</p>
                    @error('image')
                        <span class="text-xs text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Form Fields -->
            <div class="p-6 space-y-6">
                <!-- Personal Information Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Informasi Pribadi
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Nama Lengkap -->
                        <div class="form-group">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name') }}" 
                                       required
                                       class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all @error('name') border-red-500 @enderror"
                                       placeholder="Masukkan nama lengkap">
                            </div>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div class="form-group">
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                                Username <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="username" 
                                       id="username" 
                                       value="{{ old('username') }}" 
                                       required
                                       class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all @error('username') border-red-500 @enderror"
                                       placeholder="username_unik">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Username harus unik, tanpa spasi</p>
                            @error('username')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       value="{{ old('email') }}" 
                                       required
                                       class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                                       placeholder="user@example.com">
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="form-group">
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor Telepon
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="phone" 
                                       id="phone" 
                                       value="{{ old('phone') }}"
                                       class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all @error('phone') border-red-500 @enderror"
                                       placeholder="08xxxxxxxxxx">
                            </div>
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Security Section -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Keamanan
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Password -->
                        <div class="form-group">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input type="password" 
                                       name="password" 
                                       id="password" 
                                       required
                                       class="w-full pl-10 pr-12 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                                       placeholder="••••••••">
                                <button type="button" 
                                        onclick="togglePassword('password')" 
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter</p>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div class="form-group">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Konfirmasi Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <input type="password" 
                                       name="password_confirmation" 
                                       id="password_confirmation" 
                                       required
                                       class="w-full pl-10 pr-12 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all"
                                       placeholder="••••••••">
                                <button type="button" 
                                        onclick="togglePassword('password_confirmation')" 
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Role & Address Section -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#D32F2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Informasi Tambahan
                    </h3>
                    
                    <div class="space-y-5">
                        <!-- Role -->
                        <div class="form-group">
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                                Role <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="role" 
                                        id="role" 
                                        required
                                        class="appearance-none w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all bg-white @error('role') border-red-500 @enderror">
                                    <option value="">Pilih Role</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                    <option value="peminjam" {{ old('role') == 'peminjam' ? 'selected' : '' }}>peminjam</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                            @error('role')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="form-group">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                Alamat Lengkap
                            </label>
                            <div class="relative">
                                <div class="absolute top-3 left-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <textarea name="address" 
                                          id="address" 
                                          rows="4"
                                          class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all resize-none @error('address') border-red-500 @enderror"
                                          placeholder="Masukkan alamat lengkap...">{{ old('address') }}</textarea>
                            </div>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex items-center justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" 
                   class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-all font-medium">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-[#D32F2F] text-white rounded-lg hover:bg-[#B71C1C] transition-all font-medium shadow-sm hover:shadow-md flex items-center gap-2 group">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Pengguna
                </button>
            </div>
        </form>
    </div>
</div>

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

    .form-group {
        animation: fadeInUp 0.4s ease-out;
    }

    .form-group:nth-child(1) { animation-delay: 0.05s; }
    .form-group:nth-child(2) { animation-delay: 0.1s; }
    .form-group:nth-child(3) { animation-delay: 0.15s; }
    .form-group:nth-child(4) { animation-delay: 0.2s; }
</style>

<script>
    // Image Preview
    document.getElementById('image')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('imagePreview');
                const placeholder = document.getElementById('initialsPlaceholder');
                
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    // Update initials placeholder when name changes
    document.getElementById('name')?.addEventListener('input', function(e) {
        const name = e.target.value.trim();
        const placeholder = document.getElementById('initialsPlaceholder');
        const preview = document.getElementById('imagePreview');
        
        if (preview.classList.contains('hidden') && name) {
            const initials = name.split(' ')
                .map(word => word[0])
                .join('')
                .toUpperCase()
                .substring(0, 2);
            placeholder.textContent = initials || '?';
        }
    });

    // Toggle password visibility
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
        field.setAttribute('type', type);
    }

    // Form validation animation
    const form = document.getElementById('userForm');
    form?.addEventListener('submit', function(e) {
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Menyimpan...
        `;
    });

    // Smooth scroll to error
    window.addEventListener('load', function() {
        const firstError = document.querySelector('.border-red-500');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstError.focus();
        }
    });

    // Auto-format phone number
    document.getElementById('phone')?.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        e.target.value = value;
    });

    // Username validation (no spaces)
    document.getElementById('username')?.addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/\s/g, '').toLowerCase();
    });

    // Password strength indicator
    document.getElementById('password')?.addEventListener('input', function(e) {
        const password = e.target.value;
        const strength = calculatePasswordStrength(password);
        showPasswordStrength(strength);
    });

    function calculatePasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/\d/)) strength++;
        if (password.match(/[^a-zA-Z\d]/)) strength++;
        return strength;
    }

    function showPasswordStrength(strength) {
        const passwordField = document.getElementById('password');
        let existingIndicator = document.getElementById('password-strength');
        
        if (!existingIndicator) {
            existingIndicator = document.createElement('div');
            existingIndicator.id = 'password-strength';
            existingIndicator.className = 'mt-2 flex gap-1';
            passwordField.parentNode.parentNode.appendChild(existingIndicator);
        }

        const colors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-green-500'];
        const labels = ['Lemah', 'Cukup', 'Bagus', 'Kuat'];
        
        existingIndicator.innerHTML = `
            <div class="flex-1 h-1.5 rounded-full ${strength >= 1 ? colors[strength - 1] : 'bg-gray-200'}"></div>
            <div class="flex-1 h-1.5 rounded-full ${strength >= 2 ? colors[strength - 1] : 'bg-gray-200'}"></div>
            <div class="flex-1 h-1.5 rounded-full ${strength >= 3 ? colors[strength - 1] : 'bg-gray-200'}"></div>
            <div class="flex-1 h-1.5 rounded-full ${strength >= 4 ? colors[strength - 1] : 'bg-gray-200'}"></div>
        `;
        
        if (strength > 0) {
            const label = document.createElement('span');
            label.className = 'text-xs text-gray-600 ml-2';
            label.textContent = labels[strength - 1];
            existingIndicator.appendChild(label);
        }
    }

    // Confirm password match validation
    document.getElementById('password_confirmation')?.addEventListener('input', function(e) {
        const password = document.getElementById('password').value;
        const confirmation = e.target.value;
        const field = e.target;

        if (confirmation && password !== confirmation) {
            field.classList.add('border-red-500');
            field.classList.remove('border-gray-300');
            
            let errorMsg = document.getElementById('password-match-error');
            if (!errorMsg) {
                errorMsg = document.createElement('p');
                errorMsg.id = 'password-match-error';
                errorMsg.className = 'mt-1 text-sm text-red-600 flex items-center gap-1';
                errorMsg.innerHTML = `
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Password tidak cocok
                `;
                field.parentNode.parentNode.appendChild(errorMsg);
            }
        } else {
            field.classList.remove('border-red-500');
            field.classList.add('border-gray-300');
            const errorMsg = document.getElementById('password-match-error');
            if (errorMsg) errorMsg.remove();
        }
    });

    // Add animation to form sections
    const sections = document.querySelectorAll('h3');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.5s ease-out';
            }
        });
    }, { threshold: 0.1 });

    sections.forEach(section => observer.observe(section));
</script>
@endsection