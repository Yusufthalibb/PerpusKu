@extends('layouts.petugas')

@section('title', 'Dashboard Petugas')
@section('page-title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 p-4 md:p-8">
    
    <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border-l-4 border-red-600">
        <h2 class="text-2xl font-bold text-gray-900 mb-1">Selamat Datang, {{ auth()->user()->name }}!</h2>
        <p class="text-sm text-gray-500">{{ date('l, d F Y') }}</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-red-600 transition duration-300 hover:shadow-lg">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Buku</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $totalBooks ?? 0 }}</h3>
                    <small class="text-xs text-gray-500">Koleksi perpustakaan</small>
                </div>
                <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-red-600"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/><path d="M10 7H8"/><path d="M12 11H8"/><path d="M14 15H8"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-600 transition duration-300 hover:shadow-lg">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Peminjaman Aktif</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $activeBorrowingsCount ?? 0 }}</h3>
                    <small class="text-xs text-gray-500">Sedang dipinjam</small>
                </div>
                <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-blue-600"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="M12 11h4"/><path d="M12 16h4"/><path d="M8 11h.01"/><path d="M8 16h.01"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-amber-500 transition duration-300 hover:shadow-lg">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Pengajuan Pending</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $pendingRequests ?? 0 }}</h3>
                    <small class="text-xs text-gray-500">Menunggu persetujuan</small>
                </div>
                <div class="w-12 h-12 bg-amber-50 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-amber-500"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-red-700 transition duration-300 hover:shadow-lg">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Terlambat</p>
                    <h3 class="text-3xl font-bold text-red-600 mb-1">{{ $lateBorrowings ?? 0 }}</h3>
                    <small class="text-xs text-gray-500">Peminjaman terlambat</small>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-red-700"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                </div>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 mb-10">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-4">
            
            <a href="{{ route('petugas.borrowings.create') }}" class="flex flex-col items-center justify-center p-4 bg-red-50 text-red-700 rounded-lg transition duration-200 hover:bg-red-100 hover:shadow-md group">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 mb-2"><circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="M8 12h8"/></svg>
                <p class="text-sm font-medium text-center group-hover:text-red-800">Tambah Peminjaman</p>
            </a>

            <a href="{{ route('petugas.borrowings.index') }}" class="flex flex-col items-center justify-center p-4 bg-blue-50 text-blue-700 rounded-lg transition duration-200 hover:bg-blue-100 hover:shadow-md group">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 mb-2"><path d="m3 16 2 2 4-4"/><path d="M9.5 16h9"/><path d="m3 10 2 2 4-4"/><path d="M9.5 10h9"/><path d="m3 4 2 2 4-4"/><path d="M9.5 4h9"/></svg>
                <p class="text-sm font-medium text-center group-hover:text-blue-800">Lihat Peminjaman</p>
            </a>
            
            <a href="{{ route('petugas.books.create') }}" class="flex flex-col items-center justify-center p-4 bg-green-50 text-green-700 rounded-lg transition duration-200 hover:bg-green-100 hover:shadow-md group">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 mb-2"><path d="M3 3v18h18"/><path d="M3 11h18"/><path d="M3 17h14"/><path d="M7 3v14"/><path d="M14 3v14"/></svg>
                <p class="text-sm font-medium text-center group-hover:text-green-800">Tambah Buku</p>
            </a>

            <a href="{{ route('petugas.reports.index') }}" class="flex flex-col items-center justify-center p-4 bg-gray-100 text-gray-700 rounded-lg transition duration-200 hover:bg-gray-200 hover:shadow-md group">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 mb-2"><path d="M3 3v18h18"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/></svg>
                <p class="text-sm font-medium text-center group-hover:text-gray-800">Laporan</p>
            </a>
            
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        @if(isset($dueToday) && $dueToday->count() > 0)
        <div class="bg-white rounded-xl shadow-sm border border-amber-300 overflow-hidden">
            <div class="bg-amber-100 p-4 border-b border-amber-300">
                <h4 class="text-lg font-semibold text-amber-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    Peminjaman Jatuh Tempo Hari Ini
                </h4>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tenggat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($dueToday as $borrowing)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $borrowing->user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $borrowing->book->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-amber-600 font-medium">
                                {{ \Carbon\Carbon::parse($borrowing->due_date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('petugas.borrowings.show', $borrowing->id) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="bg-white rounded-xl shadow-sm p-6 border border-green-300">
             <div class="flex items-center">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-600"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                </div>
                <p class="text-sm font-medium text-green-700">Tidak ada peminjaman yang jatuh tempo hari ini.</p>
            </div>
        </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Peminjaman Terbaru</h3>
                <span class="text-sm text-gray-500">5 terakhir</span>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($recentBorrowings ?? [] as $borrowing)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $borrowing->user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ Str::limit($borrowing->book->title, 20) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">
                                {{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusClass = [
                                        'borrowed' => 'bg-amber-100 text-amber-800',
                                        'returned' => 'bg-green-100 text-green-800',
                                        'late'     => 'bg-red-100 text-red-800',
                                        'pending'  => 'bg-gray-100 text-gray-800',
                                    ][$borrowing->status ?? 'pending'] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ ucfirst($borrowing->status ?? 'N/A') }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                                Tidak ada data peminjaman terbaru.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                <a href="{{ route('petugas.borrowings.index') }}" class="text-sm font-medium text-red-600 hover:text-red-700 flex items-center group">
                    Lihat Semua Peminjaman
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-200"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Buku Stok Menipis</h3>
                <span class="text-sm text-gray-500">Perlu re-stock</span>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($lowStockBooks ?? [] as $book)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($book->title, 25) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 hidden sm:table-cell">{{ $book->category->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    {{ $book->stock }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-sm text-gray-500">
                                Semua buku stok mencukupi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                <a href="{{ route('petugas.books.index') }}" class="text-sm font-medium text-red-600 hover:text-red-700 flex items-center group">
                    Kelola Buku
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-200"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection