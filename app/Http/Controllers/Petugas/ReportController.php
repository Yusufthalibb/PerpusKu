<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrowing;
use Carbon\Carbon;

// Tambahkan impor yang diperlukan untuk Ekspor (Asumsi menggunakan DomPDF dan Maatwebsite/Laravel Excel)
// use Barryvdh\DomPDF\Facade\Pdf; // Contoh untuk PDF
// use App\Exports\ReportsExport;   // Contoh untuk Kelas Ekspor Excel
// use Maatwebsite\Excel\Facades\Excel; // Contoh untuk Excel

class ReportController extends Controller
{
    /**
     * Helper untuk mendapatkan data laporan berdasarkan periode.
     * Ini memastikan logika data terpusat dan dapat digunakan oleh index() dan export().
     */
    protected function getReportData(Carbon $start, Carbon $end)
    {
        // 2. Kueri Peminjaman dalam periode waktu
        $borrowingsInPeriod = Borrowing::whereBetween('borrow_date', [$start, $end])
            ->orWhere(function ($query) use ($start, $end) {
                // Termasuk peminjaman yang mulai sebelum periode tapi selesai di periode
                $query->where('borrow_date', '<', $start)
                      ->whereNotNull('return_date')
                      ->whereBetween('return_date', [$start, $end]);
            })
            ->with(['book', 'user'])
            ->get();

        // 3. Ringkasan Laporan
        $totalBorrowings = $borrowingsInPeriod->count(); 
        $returnedBooks = $borrowingsInPeriod->whereNotNull('return_date')->count(); 
        
        $lateBorrowings = $borrowingsInPeriod->filter(function ($borrowing) {
            // Logika sederhana: due_date < hari ini atau return_date
            $comparisonDate = $borrowing->return_date ? Carbon::parse($borrowing->return_date) : Carbon::now();
            return $borrowing->due_date < $comparisonDate;
        })->count();

        $totalFines = $borrowingsInPeriod->sum('fine'); 

        // 4. Buku Paling Banyak Dipinjam
        $mostBorrowedBooks = Borrowing::whereBetween('borrow_date', [$start, $end])
            ->selectRaw('book_id, count(*) as borrowings_count')
            ->groupBy('book_id')
            ->orderByDesc('borrowings_count')
            ->limit(10)
            ->with(['book.category']) // Memuat detail buku dan kategori
            ->get()
            ->map(function ($item) {
                $item->title = $item->book->title ?? 'Buku Tidak Diketahui';
                $item->author = $item->book->author ?? '-';
                $item->category_name = $item->book->category->name ?? '-';
                return $item;
            });
        
        // 5. Detail Keterlambatan
        $lateReturns = Borrowing::where(function ($query) use ($start, $end) {
                // Keterlambatan yang dikembalikan di periode dan return_date > due_date
                $query->whereNotNull('return_date')
                      ->whereBetween('return_date', [$start, $end])
                      ->whereColumn('return_date', '>', 'due_date');
            })
            ->orWhere(function ($query) use ($end) {
                // Peminjaman yang belum dikembalikan dan due_date sudah lewat
                $query->whereNull('return_date')
                      ->where('due_date', '<', Carbon::now());
            })
            ->whereBetween('borrow_date', [$start, $end]) // Hanya peminjaman yang dimulai di periode
            ->with(['user', 'book']) 
            ->get()
            ->map(function ($late) {
                $returnDate = $late->return_date ? Carbon::parse($late->return_date) : Carbon::now();
                $daysLate = $late->due_date < $returnDate ? Carbon::parse($late->due_date)->diffInDays($returnDate) : 0;
                
                $late->days_late = $daysLate;
                $late->fine = $late->fine ?? 0;
                
                return $late;
            });

        return [
            'totalBorrowings' => $totalBorrowings,
            'returnedBooks' => $returnedBooks,
            'lateBorrowings' => $lateBorrowings,
            'totalFines' => $totalFines,
            'mostBorrowedBooks' => $mostBorrowedBooks,
            'lateReturns' => $lateReturns,
        ];
    }


    /**
     * Menampilkan laporan perpustakaan berdasarkan periode tanggal.
     */
    public function index(Request $request)
    {
        // 1. Tentukan tanggal awal dan akhir
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->toDateString());

        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();
        
        if ($start->greaterThan($end)) {
            $temp = $start;
            $start = $end;
            $end = $temp;
            $startDate = $start->toDateString();
            $endDate = $end->toDateString();
        }

        $data = $this->getReportData($start, $end);

        return view('petugas.reports-index', array_merge($data, [
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]));
    }

    /**
     * Mengekspor laporan ke format PDF atau Excel.
     */
    public function export(Request $request, string $type)
    {
        // 1. Tentukan tanggal awal dan akhir
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->toDateString());

        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();
        
        if ($start->greaterThan($end)) {
            $temp = $start;
            $start = $end;
            $end = $temp;
        }

        // 2. Ambil semua data laporan
        $data = $this->getReportData($start, $end);
        
        // Tambahkan metadata periode
        $data['reportPeriod'] = Carbon::parse($startDate)->format('d F Y') . ' - ' . Carbon::parse($endDate)->format('d F Y');
        $data['reportDate'] = Carbon::now()->format('d M Y H:i:s');

        $filename = 'Laporan_Perpustakaan_' . $start->format('Ymd') . '_to_' . $end->format('Ymd');
        
        switch (strtolower($type)) {
            case 'pdf':
                // =========================================================
                // LOGIKA EKSPOR PDF (Contoh menggunakan DomPDF)
                // Pastikan Anda telah menginstal dan mengkonfigurasi DomPDF
                // =========================================================
                
                // Pilihan 1: Load view Blade khusus untuk layout PDF (misalnya 'petugas.reports.pdf')
                // $pdf = Pdf::loadView('petugas.reports.pdf', $data);
                
                // return $pdf->download($filename . '.pdf');

                // Placeholder: Jika DomPDF tidak terinstal
                return response()->json(['message' => 'Ekspor PDF memerlukan library DomPDF atau sejenisnya untuk diimplementasikan.', 'data' => $data], 501);

            case 'excel':
                // =========================================================
                // LOGIKA EKSPOR EXCEL (Contoh menggunakan Maatwebsite/Laravel Excel)
                // Pastikan Anda telah menginstal dan membuat class ReportsExport
                // =========================================================
                
                // Pilihan 1: Gunakan kelas Export khusus
                // return Excel::download(new ReportsExport($data), $filename . '.xlsx');

                // Placeholder: Jika Maatwebsite tidak terinstal
                return response()->json(['message' => 'Ekspor Excel memerlukan library Maatwebsite/Laravel Excel dan kelas ReportsExport untuk diimplementasikan.', 'data' => $data], 501);

            default:
                return redirect()->route('petugas.exports.excel')->with('error', 'Format ekspor tidak valid.');
        }
    }
}