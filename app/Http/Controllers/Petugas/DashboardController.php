<?php
namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;

class DashboardController extends Controller
{
    public function index()
    {
        // Angka untuk card statistik
        $activeBorrowingsCount = Borrowing::where('status', 'dipinjam')->count();
        $lowStockBooks = Book::where('stock', '<', 5)->get();
        $todayBorrowings = Borrowing::whereDate('borrow_date', today())->count();

        // Data tabel untuk "peminjaman Terbaru"
        $recentBorrowings = Borrowing::with(['user', 'book'])
            ->latest()
            ->take(5)
            ->get();

        // <-- pastikan ini ada:
        $pendingRequests = Borrowing::where('status', 'pending')->count();

        return view('petugas.dashboard', compact(
            'activeBorrowingsCount',
            'lowStockBooks',
            'todayBorrowings',
            'recentBorrowings',
            'pendingRequests' // <-- jangan lupa masukkan ke compact
        ));
    }
}
