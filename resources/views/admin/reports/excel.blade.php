<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Perpustakaan</title>
</head>
<body>
    <h1>Laporan Aktivitas Perpustakaan</h1>
    <p>Periode: {{ $startDate }} sampai {{ $endDate }}</p>

    <h2>Ringkasan Statistik</h2>
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
                <td>{{ $summary['totalBorrowings'] }}</td>
                <td>{{ $summary['returnedBooks'] }}</td>
                <td>{{ $summary['lateBorrowings'] }}</td>
                <td>Rp {{ number_format($summary['totalFines'], 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    
    <h2>Buku Paling Banyak Dipinjam (Top 10)</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Jumlah Peminjaman</th>
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
    <br>

    <h2>Peminjam Paling Aktif (Top 10)</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Total Peminjaman</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mostActiveMembers as $index => $member)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->borrowings_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>

    <h2>Detail Keterlambatan (Pengembalian Terlambat)</h2>
    <table>
        <thead>
            <tr>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tanggal Tenggat</th>
                <th>Tanggal Kembali</th>
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