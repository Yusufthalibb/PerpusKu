@extends('layouts.admin')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Pengguna</h1>
            <p class="text-sm text-gray-500 mt-1">Manage semua pengguna dalam sistem</p>
        </div>
        <a href="{{ route('admin.users.create') }}" 
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#D32F2F] text-white rounded-lg hover:bg-[#B71C1C] transition-all duration-200 shadow-sm hover:shadow-md group">
            <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span class="font-medium">Tambah Pengguna</span>
        </a>
    </div>

    <!-- Filter & Search Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col md:flex-row gap-3">
            <!-- Search Input -->
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari nama atau email..." 
                    value="{{ request('search') }}"
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all">
            </div>

            <!-- Role Filter -->
            <div class="relative">
                <select name="role" 
                        class="appearance-none w-full md:w-48 pl-4 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all bg-white">
                    <option value="">Semua Role</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="petugas" {{ request('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="peminjam" {{ request('role') == 'peminjam' ? 'selected' : '' }}>peminjam</option>
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
                <a href="{{ route('admin.users.index') }}" 
                   class="px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Users Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($users as $user)
        <div class="user-card bg-white rounded-xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition-all duration-300 group">
            <!-- User Header -->
            <div class="flex items-start gap-4 mb-4">
                <!-- User Avatar -->
                <div class="relative flex-shrink-0">
                    @if($user->image)
                        <img src="{{ asset('storage/' . $user->image) }}" 
                             alt="{{ $user->name }}"
                             class="w-16 h-16 rounded-full object-cover ring-2 ring-gray-100 group-hover:ring-[#D32F2F] transition-all">
                    @else
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-[#D32F2F] to-[#B71C1C] flex items-center justify-center text-white text-xl font-bold ring-2 ring-gray-100 group-hover:ring-[#D32F2F] transition-all">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                    @endif
                    <!-- Online Status Indicator -->
                    <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
                </div>

                <!-- User Info -->
                <div class="flex-1 min-w-0">
                    <h3 class="font-semibold text-gray-900 truncate group-hover:text-[#D32F2F] transition-colors">
                        {{ $user->name }}
                    </h3>
                    <p class="text-sm text-gray-500 truncate">{{ $user->email }}</p>
                    
                    <!-- Role Badge -->
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 mt-2 rounded-full text-xs font-medium
                        {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700' : '' }}
                        {{ $user->role == 'petugas' ? 'bg-blue-100 text-blue-700' : '' }}
                        {{ $user->role == 'peminjam' ? 'bg-green-100 text-green-700' : '' }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                </div>
            </div>

            <!-- User Details -->
            <div class="space-y-2 mb-4 pb-4 border-b border-gray-100">
                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Bergabung: {{ $user->created_at->format('d M Y') }}</span>
                </div>
                
                @if($user->role == 'peminjam')
                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span>Buku Dipinjam: {{ $user->borrowings_count ?? 0 }}</span>
                </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.users.show', $user->id) }}" 
                   class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all text-sm font-medium group/btn">
                    <svg class="w-4 h-4 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Lihat
                </a>
                
                <a href="{{ route('admin.users.edit', $user->id) }}" 
                   class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 bg-amber-100 text-amber-700 rounded-lg hover:bg-amber-200 transition-all text-sm font-medium group/btn">
                    <svg class="w-4 h-4 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                
                <button onclick="confirmDelete('{{ $user->id }}', '{{ $user->name }}')" 
                        class="px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-all group/btn">
                    <svg class="w-4 h-4 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Hidden Delete Form -->
        <form id="delete-form-{{ $user->id }}" 
              method="POST" 
              action="{{ route('admin.users.destroy', $user->id) }}" 
              class="hidden">
            @csrf
            @method('DELETE')
        </form>
        @empty
        <!-- Empty State -->
        <div class="col-span-full bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-1">Tidak Ada Pengguna</h3>
            <p class="text-gray-500 mb-4">Belum ada data pengguna yang tersedia.</p>
            <a href="{{ route('admin.users.create') }}" 
               class="inline-flex items-center gap-2 px-4 py-2 bg-[#D32F2F] text-white rounded-lg hover:bg-[#B71C1C] transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Pengguna Pertama
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 px-4 py-3">
        {{ $users->links() }}
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
                    <p class="text-sm text-gray-500 mt-1">Apakah Anda yakin ingin menghapus pengguna ini?</p>
                </div>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-3 mb-4">
                <p class="text-sm text-gray-600">Pengguna: <span class="font-semibold text-gray-900" id="deleteUserName"></span></p>
            </div>

            <p class="text-sm text-gray-500 mb-6">Tindakan ini tidak dapat dibatalkan. Semua data yang terkait dengan pengguna ini akan dihapus.</p>

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

    .user-card {
        animation: slideUp 0.3s ease-out;
    }

    .user-card:nth-child(1) { animation-delay: 0.05s; }
    .user-card:nth-child(2) { animation-delay: 0.1s; }
    .user-card:nth-child(3) { animation-delay: 0.15s; }
    .user-card:nth-child(4) { animation-delay: 0.2s; }
    .user-card:nth-child(5) { animation-delay: 0.25s; }
    .user-card:nth-child(6) { animation-delay: 0.3s; }

    #deleteModal.show {
        display: flex !important;
    }

    #deleteModal.show #modalContent {
        opacity: 1;
        transform: scale(1);
    }
</style>

<script>
    let currentDeleteUserId = null;

    function confirmDelete(userId, userName) {
        currentDeleteUserId = userId;
        document.getElementById('deleteUserName').textContent = userName;
        
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
            currentDeleteUserId = null;
        }, 200);
    }

    function submitDelete() {
        if (currentDeleteUserId) {
            document.getElementById('delete-form-' + currentDeleteUserId).submit();
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