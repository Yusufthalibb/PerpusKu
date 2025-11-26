<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Perpustakaan - {{ $data['reportPeriod'] }}</title>
    <style>
        /* Global Styles */
        body { font-family: 'Arial', sans-serif; font-size: 10pt; margin: 0; padding: 20px; }
        h1, h2, h3 { color: #333; }
        h1 { font-size: 18pt; text-align: center; margin-bottom: 5px; }
        h2 { font-size: 14pt; border-bottom: 2px solid #D32F2F; padding-bottom: 5px; margin-top: 20px; }
        p { margin: 2px 0; }
        .period { text-align: center; margin-bottom: 15px; font-size: 11pt; color: #555; }
        .footer-info { font-size: 8pt; text-align: right; color: #888; margin-top: 20px; }

        /* Table Styles */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px 10px; text-align: left; }
        th { background-color: #f5f5f5; color: #333; font-weight: bold; font-size: 9pt; }
        td { font-size: 9pt; }

        /* Specific Sections */
        .summary-grid {
            display: table;
            width: 100%;
            table-layout: fixed;
            margin-bottom: 20px;
        }
        .summary-item {
            display: table-cell;
            width: 25%;
            padding: 10px;
            border: 1px solid #eee;
            background-color: #fff;
            vertical-align: top;
        }
        .summary-title { font-size: 8pt; color: #666; text-transform: uppercase; margin-bottom: 5px; }
        .summary-value { font-size: 14pt; font-weight: bold; color: #333; }
        .summary-value-red { color: #D32F2F; }
    </style>
</head>
<body>
    
    <h1>LAPORAN PERPUSTAKAAN</h1>
    <p class="period">Periode: {{ $data['reportPeriod'] }}</p>

    {{-- RINGKASAN STATISTIK --}}
    <h2>Ringkasan Statistik</h2>
    <div class="summary-grid">
        <div class="summary-item" style="border-left: 3px solid #666;">
            <div class="summary-title">Total Peminjaman</div>
            <div class="summary-value">{{ $data['totalBorrowings'] }}</div>
        </div>
        <div class="summary-item" style="border-left: 3px solid #4CAF50;">
            <div class="summary-title">Total Dikembalikan</div>
            <div class="summary-value">{{ $data['returnedBooks'] }}</div>
        </div>
        <div class="summary-item" style="border-left: 3px solid #FFC107;">
            <div class="summary-title">Total Terlambat</div>
            <div class="summary-value">{{ $data['lateBorrowings'] }}</div>
        </div>
        <div class="summary-item" style="border-left: 3px solid #D32F2F;">
            <div class="summary-title">Total Denda (Terkumpul)</div>
            <div class="summary-value summary-value-red">Rp {{ number_format($data['totalFines'], 0, ',', '.') }}</div>
        </div>
    </div>
    
    {{-- BUKU PALING BANYAK DIPINJAM --}}
    <h2>Buku Paling Banyak Dipinjam (Top 10)</h2>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 35%;">Judul</th>
                <th style="width: 30%;">Pengarang</th>
                <th style="width: 20%;">Kategori</th>
                <th style="width: 10%;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data['mostBorrowedBooks'] as $index => $book)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->category_name }}</td>
                <td style="font-weight: bold; color: #D32F2F; text-align: center;">{{ $book->borrowings_count }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">Tidak ada data buku yang dipinjam dalam periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- DETAIL KETERLAMBATAN --}}
    <h2>Detail Keterlambatan</h2>
    <table>
        <thead>
            <tr>
                <th style="width: 20%;">Peminjam</th>
                <th style="width: 30%;">Buku</th>
                <th style="width: 15%;">Tenggat</th>
                <th style="width: 15%;">Tanggal Kembali</th>
                <th style="width: 10%;">Hari Telat</th>
                <th style="width: 10%;">Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data['lateReturns'] as $late)
            <tr>
                <td>{{ $late->user->name ?? 'Pengguna Dihapus' }}</td>
                <td>{{ $late->book->title ?? 'Buku Dihapus' }}</td>
                <td>{{ \Carbon\Carbon::parse($late->due_date)->format('d M Y') }}</td>
                <td>{{ $late->return_date ? \Carbon\Carbon::parse($late->return_date)->format('d M Y') : 'BELUM KEMBALI' }}</td>
                <td style="color: #D32F2F; text-align: center;">{{ $late->days_late }}</td>
                <td style="font-weight: bold; text-align: right;">Rp {{ number_format($late->fine, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Tidak ada keterlambatan tercatat dalam periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="footer-info">
        Laporan dibuat pada: {{ $data['reportDate'] }}
    </div>

</body>
</html>