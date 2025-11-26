<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Perpustakaan Periode {{ $startDate }} - {{ $endDate }}</title>
    <style>
        body { font-family: 'Arial', sans-serif; font-size: 10pt; }
        h1, h2 { color: #333; }
        h1 { font-size: 16pt; text-align: center; margin-bottom: 5px; }
        h2 { font-size: 12pt; margin-top: 20px; border-bottom: 1px solid #ccc; padding-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-size: 10pt; }
        .summary-box { 
            border: 1px solid #000; 
            padding: 10px; 
            margin-bottom: 20px;
            display: inline-block;
            width: 48%;
        }
        .summary-box p { margin: 5px 0; }
    </style>
</head>
<body>
    <h1>Laporan Aktivitas Perpustakaan</h1>
    <p style="text-align: center;">Periode: **{{ $startDate }}** sampai **{{ $endDate }}**</p>

    <!-- --------------------------
        1. Ringkasan Statistik
    --------------------------- -->
    <h2>1. Ringkasan Statistik</h2>
    <table>
        <thead>
            <tr>
                <th>Total Peminjaman</th>
                <th>Buku Dikembalikan</th>
                <th>Keterlambatan Saat Ini</th>
                <th>Total Denda</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $totalBorrowings }}</td>
                <td>{{ $returnedBooks }}</td>
                <td>{{ $lateBorrowings }}</td>
                <td>Rp {{ number_format($totalFines, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- --------------------------
        2. Buku Paling Banyak Dipinjam
    --------------------------- -->
    <h2>2. Buku Paling Banyak Dipinjam (Top 10)</h2>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 70%;">Judul Buku</th>
                <th style="width: 25%;">Jumlah Peminjaman</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mostBorrowedBooks as $index => $book)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->borrowings_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- --------------------------
        3. Peminjam Paling Aktif
    --------------------------- -->
    <h2>3. Peminjam Paling Aktif (Top 10)</h2>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 50%;">Nama Peminjam</th>
                <th style="width: 25%;">Total Peminjaman</th>
                <th style="width: 20%;">Telat Dikembalikan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mostActiveMembers as $index => $member)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->borrowings_count }}</td>
                <td>{{ $member->late_returns }} kali</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- --------------------------
        4. Statistik Per Kategori
    --------------------------- -->
    <h2>4. Statistik Per Kategori</h2>
    <table>
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Total Buku</th>
                <th>Total Dipinjam</th>
                <th>Persentase Peminjaman</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categoryStats as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->books_count }}</td>
                <td>{{ $category->borrowings_count }}</td>
                <td>{{ $category->percentage }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- --------------------------
        5. Detail Keterlambatan
    --------------------------- -->
    <h2>5. Detail Keterlambatan (Pengembalian Terlambat)</h2>
    <table>
        <thead>
            <tr>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tgl Tenggat</th>
                <th>Tgl Kembali</th>
                <th>Hari Terlambat</th>
                <th>Denda (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lateReturns as $late)
            <tr>
                <td>{{ $late->user->name ?? 'N/A' }}</td>
                <td>{{ $late->book->title ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($late->due_date)->format('d-M-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($late->return_date)->format('d-M-Y') }}</td>
                <td>{{ $late->days_late }}</td>
                <td>{{ number_format($late->fine, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>