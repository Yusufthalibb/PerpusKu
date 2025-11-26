<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar
        $query = Borrowing::with(['user', 'book'])->latest();

        // ================================
        // FILTER: SEARCH (nama user / judul buku)
        // ================================
        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('book', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        // ================================
        // FILTER: STATUS
        // ================================
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // ================================
        // FILTER: TANGGAL (range)
        // ================================
        if ($request->filled('date_from')) {
            $query->whereDate('borrow_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('borrow_date', '<=', $request->date_to);
        }

        // Ambil data hasil filter
        $borrowings = Borrowing::with(['user', 'book'])
    ->when($request->search, function ($q) use ($request) {
        $q->whereHas('user', function ($u) use ($request) {
            $u->where('name', 'like', '%'.$request->search.'%');
        })->orWhereHas('book', function ($b) use ($request) {
            $b->where('title', 'like', '%'.$request->search.'%');
        });
    })
    ->when($request->status, function ($q) use ($request) {
        if ($request->status === 'late') {
            $q->where('due_date', '<', now())
              ->where('status', 'borrowed');
        } else {
            $q->where('status', $request->status);
        }
    })
    ->orderBy('id', 'DESC')
    ->paginate(10);


        // ================================
        // STATISTIK KECIL (untuk card atas)
        // ================================
        $totalBorrowings     = Borrowing::count();
        $activeBorrowings    = Borrowing::where('status', 'borrowed')->count();
        $returnedBorrowings  = Borrowing::where('status', 'returned')->count();
       $lateBorrowings = Borrowing::where('status', 'borrowed')
    ->where('borrow_date', '<', now()->subDays(7))
    ->count();

        return view('admin.borrowings-index', compact(
            'borrowings',
            'totalBorrowings',
            'activeBorrowings',
            'returnedBorrowings',
            'lateBorrowings'
        ));
    }
}
