<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total data
        $totalBooks = Book::count();
        $totalUsers = User::count();
        $totalBorrowings = Borrowing::count();
        $totalReturns = Borrowing::where('status', 'returned')->count();

        // Grafik peminjaman 6 bulan terakhir
        $months = collect();
        $borrowingCounts = collect();

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('M');
            $months->push($month);

            $count = Borrowing::whereMonth('created_at', Carbon::now()->subMonths($i)->month)
                ->whereYear('created_at', Carbon::now()->subMonths($i)->year)
                ->count();

            $borrowingCounts->push($count);
        }

        // Riwayat peminjaman terbaru (5)
        $recentBorrowings = Borrowing::with(['user', 'book'])
            ->latest()
            ->limit(5)
            ->get();

        // User terbaru (5)
        $recentUsers = User::latest()->limit(5)->get();

        return view('admin.dashboard', [
            'totalBooks' => $totalBooks,
            'totalUsers' => $totalUsers,
            'totalBorrowings' => $totalBorrowings,
            'totalReturns' => $totalReturns,
            'borrowingMonths' => $months,
            'borrowingData' => $borrowingCounts,
            'recentBorrowings' => $recentBorrowings,
            'recentUsers' => $recentUsers,
        ]);
    }
}
