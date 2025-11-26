<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel; // Pastikan Anda mengimpor ini
use App\Exports\ReportsExport; // Kelas Export yang akan kita buat
use Barryvdh\DomPDF\Facade\Pdf; // Jika Anda menggunakan Barryvdh/Laravel-Dompdf

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // --- Periode Laporan ---
        // Jika request tidak ada, gunakan default: awal bulan sampai hari ini
        $startDate = $request->start_date ?? date('Y-m-01');
        $endDate   = $request->end_date ?? date('Y-m-d');

        // Konversi ke Carbon
        $start = Carbon::parse($startDate)->startOfDay();
        $end   = Carbon::parse($endDate)->endOfDay();


        // --- Ringkasan Statistik ---
        $totalBorrowings = Borrowing::whereBetween('borrow_date', [$start, $end])->count();

        $returnedBooks = Borrowing::whereNotNull('return_date')
            ->whereBetween('return_date', [$start, $end])
            ->count();

        // Keterlambatan saat ini (status 'borrowed' dan melewati due_date)
        $lateBorrowings = Borrowing::where('status', 'borrowed')
            ->whereDate('due_date', '<', now()->toDateString())
            ->count();

        $totalFines = Borrowing::whereBetween('borrow_date', [$start, $end])->sum('fine');


        // --- Buku Paling Banyak Dipinjam ---
        $mostBorrowedBooks = Book::with('category')
            ->withCount(['borrowings' => function ($q) use ($start, $end) {
                $q->whereBetween('borrow_date', [$start, $end]);
            }])
            ->orderBy('borrowings_count', 'DESC')
            ->limit(10)
            ->get();


        // --- Peminjam Paling Aktif ---
        $mostActiveMembers = User::where('role', 'member')
            ->withCount(['borrowings' => function ($q) use ($start, $end) {
                $q->whereBetween('borrow_date', [$start, $end]);
            }])
            ->withCount(['borrowings as late_returns' => function ($q) {
                // Menghitung total keterlambatan yang pernah dilakukan (return_date > due_date)
                $q->whereNotNull('return_date')->whereColumn('return_date', '>', 'due_date');
            }])
            ->orderBy('borrowings_count', 'DESC')
            ->limit(10)
            ->get();


        // --- Statistik per Kategori ---
        // Catatan: Jika Anda ingin statistik kategori berdasarkan periode, Anda harus mengubah query ini
        $categoryStats = Category::withCount('books')
            ->withCount(['borrowings' => function ($q) use ($start, $end) {
                $q->whereBetween('borrow_date', [$start, $end]);
            }])
            ->get()
            ->map(function ($category) use ($totalBorrowings) {
                $category->percentage = $totalBorrowings > 0
                    ? round(($category->borrowings_count / $totalBorrowings) * 100, 2)
                    : 0;

                return $category;
            });


        // --- Detail Keterlambatan Yang Sudah Dikembalikan ---
        // Ini menghitung keterlambatan yang terjadi (sudah dikembalikan)
        $lateReturns = Borrowing::with(['user', 'book'])
            ->whereNotNull('return_date')
            ->whereColumn('return_date', '>', 'due_date')
            ->whereBetween('return_date', [$start, $end]) // Filter berdasarkan tanggal pengembalian
            ->get()
            ->map(function ($item) {
                $item->days_late = Carbon::parse($item->return_date)->diffInDays(Carbon::parse($item->due_date));
                $item->fine = $item->fine ?? 0; // Pastikan ada fine
                return $item;
            });


        // --- Grafik Peminjaman Harian ---
        $daily = Borrowing::select(
            DB::raw('DATE(borrow_date) as day'),
            DB::raw('COUNT(*) as total')
        )
            ->whereBetween('borrow_date', [$start, $end])
            ->groupBy('day')
            ->orderBy('day', 'ASC')
            ->get();

        $dailyLabels = $daily->pluck('day');
        $dailyData   = $daily->pluck('total');


        // --- Kirim ke View ---
        return view('admin.reports-index', compact(
            'totalBorrowings',
            'returnedBooks',
            'lateBorrowings',
            'totalFines',
            'mostBorrowedBooks',
            'mostActiveMembers',
            'categoryStats',
            'lateReturns',
            'dailyLabels',
            'dailyData'
        ));
    }

    /**
     * Menangani ekspor laporan ke format Excel.
     */
    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        // Menggunakan ReportsExport class untuk men-generate file Excel
        return Excel::download(new ReportsExport($startDate, $endDate), 'laporan_perpustakaan_' . $startDate . '_to_' . $endDate . '.xlsx');
    }

    /**
     * Menangani ekspor laporan ke format PDF.
     */
    public function exportPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        // Ambil data yang dibutuhkan untuk PDF (bisa menggunakan helper method)
        $reportData = $this->getReportData($startDate, $endDate);

        // Load view khusus untuk PDF (Anda harus membuat file ini)
        $pdf = Pdf::loadView('admin.reports.pdf', $reportData);
        
        return $pdf->download('laporan_perpustakaan_' . $startDate . '_to_' . $endDate . '.pdf');
    }

    /**
     * Helper function untuk mendapatkan semua data yang dibutuhkan,
     * yang juga digunakan oleh metode exportPdf.
     */
    private function getReportData($startDate, $endDate)
    {
        $start = Carbon::parse($startDate)->startOfDay();
        $end   = Carbon::parse($endDate)->endOfDay();
        
        // Salin semua logika query dari metode index di sini
        $totalBorrowings = Borrowing::whereBetween('borrow_date', [$start, $end])->count();
        $returnedBooks = Borrowing::whereNotNull('return_date')->whereBetween('return_date', [$start, $end])->count();
        $lateBorrowings = Borrowing::where('status', 'borrowed')->whereDate('due_date', '<', now()->toDateString())->count();
        $totalFines = Borrowing::whereBetween('borrow_date', [$start, $end])->sum('fine');

        $mostBorrowedBooks = Book::withCount(['borrowings' => function ($q) use ($start, $end) {
            $q->whereBetween('borrow_date', [$start, $end]);
        }])->orderBy('borrowings_count', 'DESC')->limit(10)->get();

        $mostActiveMembers = User::where('role', 'member')
            ->withCount(['borrowings' => function ($q) use ($start, $end) {
                $q->whereBetween('borrow_date', [$start, $end]);
            }])
            ->withCount(['borrowings as late_returns' => function ($q) {
                $q->whereNotNull('return_date')->whereColumn('return_date', '>', 'due_date');
            }])
            ->orderBy('borrowings_count', 'DESC')->limit(10)->get();
            
        $lateReturns = Borrowing::with(['user', 'book'])
            ->whereNotNull('return_date')
            ->whereColumn('return_date', '>', 'due_date')
            ->whereBetween('return_date', [$start, $end])
            ->get()
            ->map(function ($item) {
                $item->days_late = Carbon::parse($item->return_date)->diffInDays(Carbon::parse($item->due_date));
                $item->fine = $item->fine ?? 0;
                return $item;
            });

        $categoryStats = Category::withCount('books')
            ->withCount(['borrowings' => function ($q) use ($start, $end) {
                $q->whereBetween('borrow_date', [$start, $end]);
            }])
            ->get()
            ->map(function ($category) use ($totalBorrowings) {
                $category->percentage = $totalBorrowings > 0
                    ? round(($category->borrowings_count / $totalBorrowings) * 100, 2)
                    : 0;
                return $category;
            });
            
        return compact(
            'totalBorrowings',
            'returnedBooks',
            'lateBorrowings',
            'totalFines',
            'mostBorrowedBooks',
            'mostActiveMembers',
            'categoryStats',
            'lateReturns',
            'startDate', // Kirim kembali tanggal
            'endDate'    // Kirim kembali tanggal
        );
    }
}