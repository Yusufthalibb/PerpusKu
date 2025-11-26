<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $userId = auth()->id();

    // Buku sedang dipinjam
    $activeBorrowings = Borrowing::where('user_id', $userId)
        ->whereIn('status', ['dipinjam', 'pending'])
        ->with('book')
        ->get();

    // Hitung total peminjaman
    $totalBorrowings = Borrowing::where('user_id', $userId)->count();

    // Buku jatuh tempo 3 hari
    $dueSoon = Borrowing::where('user_id', $userId)
        ->where('status', 'dipinjam')
        ->whereDate('due_date', '<=', now()->addDays(3))
        ->with('book')
        ->get();

    $dueSoonCount = $dueSoon->count();

    // Buku tersedia
    $availableBooks = Book::where('stock', '>', 0)->count();

    // peminjaman terbaru
    $recentBorrowings = Borrowing::where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->with('book')
        ->get();

    // Buku yang sedang dipinjam (grid)
    $currentBorrowings = $activeBorrowings;

    // Rekomendasi
    $recommendedBooks = Book::inRandomOrder()->take(3)->get();

    return view('peminjam.dashboard', compact(
        'activeBorrowings',
        'totalBorrowings',
        'dueSoon',
        'dueSoonCount',
        'availableBooks',
        'currentBorrowings',
        'recommendedBooks',
        'recentBorrowings'
    ));
}

}