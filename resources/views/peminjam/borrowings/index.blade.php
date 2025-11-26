@extends('layouts.peminjam')

@section('title', 'Peminjaman Saya')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6">
    <div class="max-w-7xl mx-auto" x-data="{ activeTab: 'all' }">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Peminjaman Saya</h1>
            <p class="text-gray-600">Kelola dan pantau buku yang Anda pinjam</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <!-- Active Borrowings -->
            <div class="bg-white rounded-lg border-l-4 border-red-600 shadow-sm hover:shadow-md transition-shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Sedang Dipinjam</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $activeBorrowingsCount ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747 0-6.002-4.5-10.747-10-10.747z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Borrowings -->
            <div class="bg-white rounded-lg border-l-4 border-blue-600 shadow-sm hover:shadow-md transition-shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Peminjaman</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalBorrowingsCount ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747 0-6.002-4.5-10.747-10-10.747z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Returned -->
            <div class="bg-white rounded-lg border-l-4 border-emerald-600 shadow-sm hover:shadow-md transition-shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Dikembalikan</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $returnedCount ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Late Borrowings -->
            <div class="bg-white rounded-lg border-l-4 border-red-600 shadow-sm hover:shadow-md transition-shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Terlambat</p>
                        <p class="text-3xl font-bold text-red-600 mt-2">{{ $lateCount ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="flex gap-3 mb-8 bg-white p-4 rounded-lg shadow-sm">
            <a href="{{ route('peminjam.borrowings.index') }}" 
               @click="activeTab = 'all'"
               :class="activeTab === 'all' ? 'border-b-2 border-red-600 text-red-600 font-semibold' : 'text-gray-600 hover:text-gray-900'"
               class="pb-2 px-4 transition-colors">
                Semua
            </a>
            <a href="{{ route('peminjam.borrowings.index', ['status' => 'borrowed']) }}" 
               @click="activeTab = 'borrowed'"
               :class="activeTab === 'borrowed' ? 'border-b-2 border-red-600 text-red-600 font-semibold' : 'text-gray-600 hover:text-gray-900'"
               class="pb-2 px-4 transition-colors">
                Sedang Dipinjam
            </a>
            <a href="{{ route('peminjam.borrowings.index', ['status' => 'returned']) }}" 
               @click="activeTab = 'returned'"
               :class="activeTab === 'returned' ? 'border-b-2 border-red-600 text-red-600 font-semibold' : 'text-gray-600 hover:text-gray-900'"
               class="pb-2 px-4 transition-colors">
                Dikembalikan
            </a>
        </div>

        <!-- Active Borrowings Section -->
        @if(isset($activeBorrowings) && $activeBorrowings->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Buku yang Sedang Dipinjam</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($activeBorrowings as $borrowing)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden border-t-4 {{ \Carbon\Carbon::parse($borrowing->due_date)->isPast() ? 'border-t-red-600' : 'border-t-emerald-600' }}">
                    
                    <!-- Late Badge -->
                    @if(\Carbon\Carbon::parse($borrowing->due_date)->isPast())
                    <div class="bg-red-50 border-b border-red-200 px-6 py-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-semibold text-red-800">Terlambat! Segera kembalikan</span>
                    </div>
                    @endif

                    <div class="p-6">
                        <!-- Book Info -->
                        <div class="flex gap-4 mb-6">
                            <div class="flex-shrink-0">
                                @if ($borrowing->book->image && Storage::disk('public')->exists($borrowing->book->image))
                                    <img src="{{ asset('storage/' . $borrowing->book->image) }}" alt="{{ $borrowing->book->title }}" class="w-24 h-32 object-cover rounded-lg shadow">
                                @else
                                    <div class="w-24 h-32 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex items-center justify-center">
                                        <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747 0-6.002-4.5-10.747-10-10.747z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $borrowing->book->title }}</h3>
                                <p class="text-gray-600 text-sm mb-3">{{ $borrowing->book->author }}</p>
                                <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ $borrowing->book->category->name ?? '-' }}
                                </span>
                            </div>
                        </div>

                        <!-- Dates Info -->
                        <div class="space-y-3 mb-6 pb-6 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Tanggal Pinjam</span>
                                <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Tenggat Kembali</span>
                                <span class="font-semibold {{ \Carbon\Carbon::parse($borrowing->due_date)->isPast() ? 'text-red-600' : 'text-gray-900' }}">
                                    {{ \Carbon\Carbon::parse($borrowing->due_date)->format('d M Y') }}
                                </span>
                            </div>
                            @if($borrowing->return_date)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Tanggal Dikembalikan</span>
                                <span class="font-semibold text-emerald-600">{{ \Carbon\Carbon::parse($borrowing->return_date)->format('d M Y') }}</span>
                            </div>
                            @endif
                        </div>

                        <!-- Action Button -->
                        <a href="{{ route('peminjam.books.show', $borrowing->book->id) }}" class="w-full inline-block text-center bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                            Lihat Detail Buku
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Borrowing History Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900">Riwayat Peminjaman</h2>
            </div>

            @if($borrowings->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Buku</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Pinjam</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Kembali</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Denda</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($borrowings as $borrowing)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $borrowing->book->title }}</p>
                                    <p class="text-sm text-gray-600">{{ $borrowing->book->author }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-900">{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-gray-900">
                                @if($borrowing->return_date)
                                    {{ \Carbon\Carbon::parse($borrowing->return_date)->format('d M Y') }}
                                @else
                                    <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-1 rounded-full">Belum dikembalikan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($borrowing->status == 'pending')
                                    <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-1 rounded-full">Menunggu ACC</span>
                                @elseif($borrowing->status == 'dipinjam')
                                    <span class="inline-block bg-emerald-100 text-emerald-800 text-xs font-semibold px-2.5 py-1 rounded-full">Dipinjam</span>
                                @elseif($borrowing->status == 'dikembalikan')
                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-1 rounded-full">Selesai</span>
                                @elseif($borrowing->status == 'terlambat')
                                    <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-1 rounded-full">Terlambat</span>
                                @elseif($borrowing->status == 'ditolak')
                                    <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-1 rounded-full">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($borrowing->fine && $borrowing->fine > 0)
                                    <span class="font-semibold text-red-600">Rp {{ number_format($borrowing->fine, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $borrowings->links() }}
            </div>
            @else
            <div class="px-6 py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747 0-6.002-4.5-10.747-10-10.747z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Peminjaman</h3>
                <p class="text-gray-600 mb-6">Anda belum pernah meminjam buku. Mulai jelajahi katalog kami!</p>
                <a href="{{ route('peminjam.books.index') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                    Jelajahi Katalog Buku
                </a>
            </div>
            @endif
        </div>

        <!-- Borrowing Rules -->
        <div class="bg-gradient-to-br from-red-50 to-red-100 border-l-4 border-red-600 rounded-lg p-6">
            <div class="flex gap-4">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1H9v2H7V4zm3 0h2v2h-2V4zm3 0h2v2h-2V4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">ℹ️ Aturan Peminjaman</h3>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex gap-3">
                            <span class="text-red-600 font-bold">•</span>
                            <span>Durasi peminjaman: <strong>14 hari</strong> dari tanggal peminjaman</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="text-red-600 font-bold">•</span>
                            <span>Denda keterlambatan: <strong>Rp 1.000 per hari</strong></span>
                        </li>
                        <li class="flex gap-3">
                            <span class="text-red-600 font-bold">•</span>
                            <span>Maksimal peminjaman sekaligus: <strong>3 buku</strong></span>
                        </li>
                        <li class="flex gap-3">
                            <span class="text-red-600 font-bold">•</span>
                            <span>Perpanjangan dapat dilakukan <strong>1 kali</strong> sebelum jatuh tempo</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="text-red-600 font-bold">•</span>
                            <span>Hubungi petugas perpustakaan untuk perpanjangan</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="text-red-600 font-bold">•</span>
                            <span>Kembalikan buku dalam kondisi baik</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection