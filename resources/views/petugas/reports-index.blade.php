{{-- resources/views/petugas/reports/index.blade.php --}}
@extends('layouts.petugas')

@section('title', 'Laporan Perpustakaan')
@section('page-title', 'Laporan')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        
        <header class="mb-6 flex justify-between items-center border-b pb-4">
            <h2 class="text-3xl font-extrabold text-gray-800 flex items-center">
                <i data-lucide="bar-chart-3" class="w-8 h-8 text-[#D32F2F] mr-3"></i>
                Laporan Perpustakaan
            </h2>
            <div class="flex space-x-2 print:hidden">
                {{-- Tombol Ekspor PDF --}}
                <a 
                    href="{{ route('petugas.reports.export', ['type' => 'pdf', 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" 
                    class="flex items-center text-sm font-medium text-white bg-red-600 hover:bg-red-700 transition duration-150 ease-in-out rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2"
                >
                    <i data-lucide="file-text" class="w-5 h-5 mr-2"></i>
                    Export PDF
                </a>
                
                {{-- Tombol Ekspor Excel --}}
                <a 
                    href="{{ route('petugas.reports.export', ['type' => 'excel', 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" 
                    class="flex items-center text-sm font-medium text-gray-700 hover:text-green-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                >
                    <i data-lucide="file-spreadsheet" class="w-5 h-5 mr-2 text-green-600"></i>
                    Export Excel
                </a>
                
                {{-- Tombol Print Asli --}}
                <button onclick="window.print()" class="flex items-center text-sm font-medium text-gray-700 hover:text-[#D32F2F] transition duration-150 ease-in-out bg-white border border-gray-300 rounded-lg px-4 py-2 shadow-sm">
                    <i data-lucide="printer" class="w-5 h-5 mr-2"></i>
                    Print
                </button>
            </div>
        </header>

        {{-- Filter Periode Laporan --}}
        <div class="report-filter mb-8 p-4 bg-white rounded-xl shadow-md print:hidden">
            <form method="GET" action="{{ route('petugas.reports.index') }}" class="flex flex-col lg:flex-row items-end lg:items-center space-y-3 lg:space-y-0 lg:space-x-4">
                <div class="filter-group flex flex-col md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-4 w-full">
                    <label for="start_date" class="text-gray-600 font-semibold whitespace-nowrap">Periode Laporan:</label>
                    <div class="flex items-center space-x-2 w-full md:w-auto">
                        <input 
                            type="date" 
                            id="start_date"
                            name="start_date" 
                            value="{{ request('start_date', $startDate ?? date('Y-m-01')) }}" 
                            required 
                            class="p-2 border border-gray-300 rounded-lg focus:border-[#D32F2F] focus:ring-1 focus:ring-[#D32F2F] w-full"
                        >
                        <span class="text-gray-500 font-medium whitespace-nowrap">sampai</span>
                        <input 
                            type="date" 
                            id="end_date"
                            name="end_date" 
                            value="{{ request('end_date', $endDate ?? date('Y-m-d')) }}" 
                            required 
                            class="p-2 border border-gray-300 rounded-lg focus:border-[#D32F2F] focus:ring-1 focus:ring-[#D32F2F] w-full"
                        >
                    </div>
                    <button type="submit" class="w-full lg:w-auto flex items-center justify-center px-4 py-2 bg-[#D32F2F] text-white font-semibold rounded-lg shadow-md hover:bg-[#B71C1C] focus:outline-none focus:ring-2 focus:ring-[#D32F2F] focus:ring-offset-2 transition duration-150 ease-in-out">
                        <i data-lucide="play" class="w-4 h-4 mr-2"></i>
                        Generate
                    </button>
                </div>
            </form>
        </div>
        
        <p class="text-lg font-medium text-gray-600 mb-6 print-only">
            **Periode Laporan:** {{ \Carbon\Carbon::parse(request('start_date', $startDate ?? date('Y-m-01')))->format('d F Y') }} - {{ \Carbon\Carbon::parse(request('end_date', $endDate ?? date('Y-m-d')))->format('d F Y') }}
        </p>

        {{-- Ringkasan Statistik --}}
        <div class="report-summary mb-8">
            <h3 class="text-xl font-bold text-gray-700 mb-4 border-l-4 border-[#D32F2F] pl-3">
                Ringkasan Statistik
            </h3>
            
            <div class="stats-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Stat Card: Total Peminjaman --}}
                <div class="stat-card bg-white p-5 rounded-xl shadow-lg border-l-4 border-gray-400">
                    <div class="flex items-center justify-between">
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Peminjaman</h4>
                        <i data-lucide="book-open-check" class="w-6 h-6 text-gray-400"></i>
                    </div>
                    <p class="stat-number text-3xl font-bold text-gray-900 mt-1">{{ $totalBorrowings ?? 0 }}</p>
                </div>

                {{-- Stat Card: Dikembalikan --}}
                <div class="stat-card bg-white p-5 rounded-xl shadow-lg border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Dikembalikan</h4>
                        <i data-lucide="check-square" class="w-6 h-6 text-green-500"></i>
                    </div>
                    <p class="stat-number text-3xl font-bold text-gray-900 mt-1">{{ $returnedBooks ?? 0 }}</p>
                </div>

                {{-- Stat Card: Terlambat --}}
                <div class="stat-card bg-white p-5 rounded-xl shadow-lg border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Terlambat</h4>
                        <i data-lucide="clock" class="w-6 h-6 text-yellow-500"></i>
                    </div>
                    <p class="stat-number text-3xl font-bold text-yellow-600 mt-1">{{ $lateBorrowings ?? 0 }}</p>
                </div>

                {{-- Stat Card: Total Denda --}}
                <div class="stat-card bg-white p-5 rounded-xl shadow-lg border-l-4 border-[#D32F2F]">
                    <div class="flex items-center justify-between">
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Denda (Terkumpul)</h4>
                        <i data-lucide="wallet" class="w-6 h-6 text-[#D32F2F]"></i>
                    </div>
                    <p class="stat-number text-3xl font-bold text-[#D32F2F] mt-1">Rp {{ number_format($totalFines ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        
        <hr class="my-8">

        {{-- Section: Buku Paling Banyak Dipinjam --}}
        <div class="report-section mb-8 bg-white p-6 rounded-xl shadow-lg overflow-x-auto">
            <h3 class="text-xl font-bold text-gray-700 mb-4 border-l-4 border-blue-500 pl-3 flex items-center">
                <i data-lucide="bookmark" class="w-5 h-5 mr-2 text-blue-500"></i>
                Buku Paling Banyak Dipinjam
            </h3>
            <table class="min-w-full divide-y divide-gray-200 data-table w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-4/12">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-3/12">Pengarang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">Jumlah Pinjam</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($mostBorrowedBooks ?? [] as $index => $book)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $book->title }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $book->author }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $book->category_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#D32F2F]">{{ $book->borrowings_count }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada data buku yang dipinjam dalam periode ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Section: Detail Keterlambatan --}}
        <div class="report-section bg-white p-6 rounded-xl shadow-lg overflow-x-auto">
            <h3 class="text-xl font-bold text-gray-700 mb-4 border-l-4 border-yellow-500 pl-3 flex items-center">
                <i data-lucide="alert-triangle" class="w-5 h-5 mr-2 text-yellow-500"></i>
                Detail Keterlambatan
            </h3>
            <table class="min-w-full divide-y divide-gray-200 data-table w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tenggat Kembali</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kembali</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari Terlambat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Denda</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($lateReturns ?? [] as $late)
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $late->user->name ?? 'Pengguna Dihapus' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $late->book->title ?? 'Buku Dihapus' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ \Carbon\Carbon::parse($late->due_date)->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $late->return_date ? \Carbon\Carbon::parse($late->return_date)->format('d M Y') : 'BELUM KEMBALI' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-red-600">{{ $late->days_late }} hari</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#D32F2F]">Rp {{ number_format($late->fine, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Tidak ada keterlambatan tercatat dalam periode ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
    // Inisialisasi Lucide Icons setelah konten dimuat
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
<style>
    /* CSS Tambahan untuk Print: Hanya menampilkan teks periode di mode cetak */
    @media print {
        .print-only {
            display: block !important;
        }
        .print\:hidden, .report-filter {
            display: none !important;
        }
        /* Memastikan tabel terlihat baik saat dicetak */
        table {
            border-collapse: collapse !important;
            width: 100% !important;
        }
        th, td {
            border: 1px solid #ccc !important;
            padding: 8px !important;
        }
    }
    .print-only {
        display: none; /* Sembunyikan secara default */
    }
</style>
@endsection