@extends('layouts.admin')

@section('title', 'Laporan')
@section('page-title', 'Laporan')

@push('styles')
    <style>
        /* Custom styles for print media */
        @media print {
            body {
                background-color: #fff !important;
            }
            .no-print {
                display: none !important;
            }
            .print-area {
                margin: 0;
                padding: 0;
                box-shadow: none;
            }
        }

        /* Animation Keyframes */
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
            animation: fadeInUp 0.5s ease-out both;
        }
    </style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50 p-4 sm:p-6 lg:p-8 print-area">
    <header class="mb-8 no-print animate-fadeInUp">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-[#D32F2F]"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
            Laporan Perpustakaan
        </h1>
        <p class="text-sm text-gray-500 mt-1">Hasilkan dan lihat statistik kunci mengenai aktivitas perpustakaan.</p>
    </header>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8 no-print animate-fadeInUp" style="animation-delay: 0.1s;">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Pilih Periode Laporan</h3>
        
        <form id="filter-form" method="GET" action="{{ route('admin.reports.index') }}" class="flex flex-col md:flex-row items-start md:items-end gap-4">
            
            <div class="w-full md:flex-1 md:min-w-0">
                <label for="start_date" class="text-sm font-medium text-gray-700 block mb-1">Dari Tanggal</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date', date('Y-m-01')) }}" required 
                           class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all duration-200 text-sm">
                </div>
            </div>

            <div class="w-full md:flex-1 md:min-w-0">
                <label for="end_date" class="text-sm font-medium text-gray-700 block mb-1">Sampai Tanggal</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date', date('Y-m-d')) }}" required 
                           class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent transition-all duration-200 text-sm">
                </div>
            </div>

            {{-- MODIFIKASI: Menambahkan Dropdown Ekspor --}}
            <div class="flex flex-wrap gap-3 w-full md:w-auto mt-2 md:mt-0">
                <button type="submit" 
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-[#D32F2F] text-white hover:bg-[#B71C1C] transition-all duration-200 font-medium whitespace-nowrap flex-1 justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                    Generate
                </button>
                
                {{-- Tombol Ekspor Dropdown --}}
                <div class="relative inline-block text-left">
                    <button type="button" id="export-dropdown-button"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition-all duration-200 font-medium whitespace-nowrap justify-center focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-[#D32F2F]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M12 2v10"/><path d="M18.4 8.6L12 15l-6.4-6.4"/></svg>
                        Ekspor
                    </button>

                    <div id="export-dropdown-menu" class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 hidden" role="menu" aria-orientation="vertical" aria-labelledby="export-dropdown-button" tabindex="-1">
                        <div class="py-1" role="none">
                            {{-- Link Ekspor Excel (Pastikan rute 'admin.reports.export.excel' ada) --}}
                            <a href="#" id="export-excel-link" onclick="handleExport('excel')" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 flex items-center gap-2" role="menuitem" tabindex="-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-green-600"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M18 17H6"/></svg>
                                Excel
                            </a>
                            {{-- Link Ekspor PDF (Pastikan rute 'admin.reports.export.pdf' ada) --}}
                            <a href="#" id="export-pdf-link" onclick="handleExport('pdf')" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 flex items-center gap-2" role="menuitem" tabindex="-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-red-600"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><rect width="6" height="4" x="9" y="13"/></svg>
                                PDF
                            </a>
                        </div>
                    </div>
                </div>

                
            </div>
            {{-- AKHIR MODIFIKASI --}}
        </form>
    </div>

    <section class="mb-8 animate-fadeInUp" style="animation-delay: 0.2s;">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Periode: <span class="text-[#D32F2F]">{{ request('start_date') }} - {{ request('end_date') }}</span></h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 group hover:scale-[1.02] hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <h4 class="text-sm font-medium text-gray-500">Total Peminjaman</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-[#D32F2F] transition-transform group-hover:scale-110"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>
                </div>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalBorrowings ?? 0 }}</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 group hover:scale-[1.02] hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <h4 class="text-sm font-medium text-gray-500">Buku Dikembalikan</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-green-500 transition-transform group-hover:scale-110"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg>
                </div>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $returnedBooks ?? 0 }}</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 group hover:scale-[1.02] hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <h4 class="text-sm font-medium text-gray-500">Keterlambatan</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-red-500 transition-transform group-hover:scale-110"><path d="m21.73 18.73-3.1-3.1A2 2 0 0 0 16 15h-3v-3l3.9-3.9A2 2 0 0 0 17 8V7h-4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h3a2 2 0 0 0 1.73-.73z"/></svg>
                </div>
                <p class="text-3xl font-bold text-red-500 mt-2">{{ $lateBorrowings ?? 0 }}</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 group hover:scale-[1.02] hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <h4 class="text-sm font-medium text-gray-500">Total Denda</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-yellow-500 transition-transform group-hover:scale-110"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <p class="text-2xl font-bold text-gray-900 mt-2">Rp {{ number_format($totalFines ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>
    </section>

    <hr class="border-gray-200 my-8">

    <section class="mb-8 animate-fadeInUp" style="animation-delay: 0.3s;">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-500"><path d="M3 3v18h18"/><path d="M18.7 8l-5.1 5.2-2.8-2.7L7 16.2"/></svg>
                Grafik Peminjaman Harian
            </h3>
            <div class="w-full h-64 md:h-96"> 
                <canvas id="dailyBorrowingChart"></canvas>
            </div>
        </div>
    </section>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <section class="animate-fadeInUp" style="animation-delay: 0.4s;">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-500"><path d="M12 2l1.4 4.5H19l-4.6 3.4 1.4 4.5L12 13.5l-4.2 3.4 1.4-4.5L5 6.5h5.6L12 2z"/></svg>
                    Buku Paling Banyak Dipinjam
                </h3>
                <div class="overflow-x-auto"> 
                    <table class="w-full text-sm text-left text-gray-500 min-w-[500px]"> 
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-medium">#</th>
                                <th scope="col" class="px-6 py-3 font-medium">Cover</th>
                                <th scope="col" class="px-6 py-3 font-medium">Judul Buku</th>
                                <th scope="col" class="px-6 py-3 font-medium">Peminjaman</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mostBorrowedBooks ?? [] as $index => $book)
                            <tr class="bg-white border-b hover:bg-gray-50 transition-colors duration-150 cursor-pointer"
                                onclick="window.location.href = '{{ url('admin/books/' . $book->id) }}'">
                                <td class="px-6 py-4 font-bold text-gray-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <img src="{{ asset('storage/books/' . ($book->cover_image ?? '')) }}" 
                                        alt="Cover {{ $book->title ?? 'Buku' }}" 
                                        class="w-10 h-14 object-cover rounded-md shadow-sm border border-gray-200" 
                                        onerror="this.onerror=null;this.src='https://via.placeholder.com/40x56?text=No+Cover';">
                                </td>
                                <td class="px-6 py-4">{{ $book->title }}</td>
                                <td class="px-6 py-4 font-medium text-[#D32F2F]">{{ $book->borrowings_count }} kali</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 text-gray-400 mb-2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>
                                        <h4 class="text-base font-medium text-gray-700">Belum ada buku yang dipinjam.</h4>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="animate-fadeInUp" style="animation-delay: 0.5s;">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-500"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Peminjam Paling Aktif
                </h3>
                <div class="overflow-x-auto"> 
                    <table class="w-full text-sm text-left text-gray-500 min-w-[500px]">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-medium">#</th>
                                <th scope="col" class="px-6 py-3 font-medium">Nama</th>
                                <th scope="col" class="px-6 py-3 font-medium">Peminjaman</th>
                                <th scope="col" class="px-6 py-3 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mostActiveMembers ?? [] as $index => $member)
                            <tr class="bg-white border-b hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 font-bold text-gray-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $member->name }}</td>
                                <td class="px-6 py-4">{{ $member->borrowings_count }} kali</td>
                                <td class="px-6 py-4">
                                    @if(($member->late_returns ?? 0) > 0)
                                         <span class="rounded-full px-2.5 py-1 text-xs font-medium bg-red-100 text-red-700">
                                             {{ $member->late_returns }} terlambat
                                         </span>
                                    @else
                                         <span class="rounded-full px-2.5 py-1 text-xs font-medium bg-green-100 text-green-700">
                                             Baik
                                         </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 text-gray-400 mb-2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                        <h4 class="text-base font-medium text-gray-700">Belum ada aktivitas peminjaman.</h4>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </div> {{-- End Grid --}}
    
    <hr class="border-gray-200 my-8">

    <section class="mb-8 animate-fadeInUp" style="animation-delay: 0.6s;">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-red-500"><path d="M10 2h4"/><path d="M12 14v-4"/><path d="M4 13a8 8 0 0 1 16 0A2 2 0 0 1 20 15v1a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2v-1a2 2 0 0 1-2-2 2 2 0 0 1-2-2"/></svg>
                Detail Keterlambatan
            </h3>
            <div class="overflow-x-auto"> 
                <table class="w-full text-sm text-left text-gray-500 min-w-[700px]">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">Peminjam</th>
                            <th scope="col" class="px-6 py-3 font-medium">Buku</th>
                            <th scope="col" class="px-6 py-3 font-medium">Tenggat</th>
                            <th scope="col" class="px-6 py-3 font-medium">Hari Terlambat</th>
                            <th scope="col" class="px-6 py-3 font-medium">Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lateReturns ?? [] as $late)
                        <tr class="bg-white border-b hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $late->user->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $late->book->title ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($late->due_date)->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-red-500 font-bold">{{ $late->days_late }} hari</td>
                            <td class="px-6 py-4 text-red-700 font-bold">Rp {{ number_format($late->fine, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center py-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 text-gray-400 mb-2"><path d="M5 22h14"/><path d="M5 18h14"/><path d="M17 22v-4"/><path d="M7 22v-4"/><path d="M12 18V2"/></svg>
                                    <h4 class="text-base font-medium text-gray-700">Tidak ada keterlambatan pada periode ini.</h4>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    
    <section class="mb-8 animate-fadeInUp" style="animation-delay: 0.7s;">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-500"><path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-4"/></svg>
                Statistik per Kategori
            </h3>
            <div class="overflow-x-auto"> 
                <table class="w-full text-sm text-left text-gray-500 min-w-[600px]">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">Kategori</th>
                            <th scope="col" class="px-6 py-3 font-medium">Jumlah Buku</th>
                            <th scope="col" class="px-6 py-3 font-medium">Total Dipinjam</th>
                            <th scope="col" class="px-6 py-3 font-medium">Persentase Peminjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categoryStats ?? [] as $stat)
                        <tr class="bg-white border-b hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $stat->name }}</td>
                            <td class="px-6 py-4">{{ $stat->books_count }}</td>
                            <td class="px-6 py-4">{{ $stat->borrowings_count }}</td>
                            <td class="px-6 py-4">
                                <div class="w-full bg-gray-200 rounded-full h-2.5 relative">
                                    <div class="bg-[#D32F2F] h-2.5 rounded-full transition-all duration-500" style="width: {{ $stat->percentage }}%"></div>
                                    <span class="absolute right-0 top-0 -mt-5 text-xs text-gray-500 font-medium">{{ $stat->percentage }}%</span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center py-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 text-gray-400 mb-2"><path d="M22 10s-3.5 1.5-3.5 4.5A1.5 1.5 0 0 1 17 16H8a1 1 0 0 0 0 2h7"/></svg>
                                    <h4 class="text-base font-medium text-gray-700">Tidak ada data statistik kategori.</h4>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Smooth scroll ke error pertama (Fitur JS)
    document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error') && document.querySelector('.border-red-500')) {
            document.querySelector('.border-red-500').scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        // Close modal dengan ESC key atau click outside (Fitur JS)
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && document.querySelector('.modal-is-open')) {
                // Logic untuk menutup modal di sini
            }
        });

        // Fungsionalitas Dropdown Ekspor
        const dropdownButton = document.getElementById('export-dropdown-button');
        const dropdownMenu = document.getElementById('export-dropdown-menu');

        if (dropdownButton && dropdownMenu) {
            dropdownButton.addEventListener('click', () => {
                const isHidden = dropdownMenu.classList.contains('hidden');
                if (isHidden) {
                    dropdownMenu.classList.remove('hidden');
                } else {
                    dropdownMenu.classList.add('hidden');
                }
            });

            // Tutup dropdown saat klik di luar
            document.addEventListener('click', (event) => {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        }
    });

    /**
     * Menangani pengiriman form untuk ekspor Excel atau PDF.
     * Menggunakan route helper Laravel yang di-inject di Blade.
     * @param {string} type - 'excel' atau 'pdf'
     */
    function handleExport(type) {
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;
        
        let url;
        if (type === 'excel') {
            // Pastikan rute ini telah didefinisikan di web.php Anda
            url = '{{ route('admin.reports.export.excel') }}'; 
        } else if (type === 'pdf') {
            // Pastikan rute ini telah didefinisikan di web.php Anda
            url = '{{ route('admin.reports.export.pdf') }}'; 
        } else {
            return;
        }

        // Tambahkan parameter tanggal ke URL
        const exportUrl = `${url}?start_date=${startDate}&end_date=${endDate}`;
        window.location.href = exportUrl;

        // Tutup dropdown setelah klik
        document.getElementById('export-dropdown-menu').classList.add('hidden');
    }

    // Chart.js Configuration
    const ctx = document.getElementById('dailyBorrowingChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($dailyLabels ?? []) !!},
                datasets: [{
                    label: 'Peminjaman per Hari',
                    data: {!! json_encode($dailyData ?? []) !!},
                    backgroundColor: 'rgba(211, 47, 47, 0.1)',
                    borderColor: '#D32F2F',
                    borderWidth: 2,
                    pointBackgroundColor: '#D32F2F',
                    tension: 0.4, // Smooth curve
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, 
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: {
                                family: 'Inter',
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(27, 27, 27, 0.9)',
                        titleFont: {
                            family: 'Inter',
                            weight: 'bold'
                        },
                        bodyFont: {
                            family: 'Inter',
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: 'Inter',
                                size: 12
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            font: {
                                family: 'Inter',
                                size: 12
                            }
                        },
                        grid: {
                            color: 'rgba(200, 200, 200, 0.2)'
                        }
                    }
                }
            }
        });
    }
</script>
@endpush