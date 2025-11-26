<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Perpustakaan - {{ $data['reportPeriod'] }}</title>
    <style>
        /* Gaya minimalis untuk Excel */
        body { font-family: sans-serif; }
        .header { background-color: #f2f2f2; font-weight: bold; }
        .currency { text-align: right; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    
    <h2>LAPORAN PERPUSTAKAAN</h2>
    <p>Periode: {{ $data['reportPeriod'] }}</p>
    <p>Tanggal Export: {{ $data['reportDate'] }}</p>

    {{-- RINGKASAN STATISTIK --}}
    <table>
        <thead>
            <tr class="header">
                <th>Statistik</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Peminjaman</td>
                <td>{{ $data['totalBorrowings'] }}</td>
            </tr>
            <tr>
                <td>Total Dikembalikan</td>
                <td>{{ $data['returnedBooks'] }}</td>
            </tr>
            <tr>
                <td>Total Terlambat</td>
                <td>{{ $data['lateBorrowings'] }}</td>
            </tr>
            <tr>
                <td>Total Denda (Terkumpul)</td>
                <td class="currency">Rp {{ number_format($data['totalFines'], 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    
    <br><br>

    {{-- BUKU PALING BANYAK DIPINJAM --}}
    <h3>BUKU PALING BANYAK DIPINJAM (Top 10)</h3>
    <table>
        <thead>
            <tr class="header">
                <th>No</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Kategori</th>
                <th>Jumlah Pinjam</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data['mostBorrowedBooks'] as $index => $book)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->category_name }}</td>
                <td>{{ $book->borrowings_count }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Tidak ada data buku yang dipinjam dalam periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <br><br>

    {{-- DETAIL KETERLAMBATAN --}}
    <h3>DETAIL KETERLAMBATAN</h3>
    <table>
        <thead>
            <tr class="header">
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tenggat Kembali</th>
                <th>Tanggal Kembali</th>
                <th>Hari Terlambat</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data['lateReturns'] as $late)
            <tr>
                <td>{{ $late->user->name ?? 'Pengguna Dihapus' }}</td>
                <td>{{ $late->book->title ?? 'Buku Dihapus' }}</td>
                <td>{{ \Carbon\Carbon::parse($late->due_date)->format('d M Y') }}</td>
                <td>{{ $late->return_date ? \Carbon\Carbon::parse($late->return_date)->format('d M Y') : 'BELUM KEMBALI' }}</td>
                <td>{{ $late->days_late }} hari</td>
                <td class="currency">Rp {{ number_format($late->fine, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Tidak ada keterlambatan tercatat dalam periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>