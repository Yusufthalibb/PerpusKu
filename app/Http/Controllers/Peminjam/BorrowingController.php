<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    // Meminjam buku
    public function store(Request $request, Book $book)
{
    // Cek apakah user punya pengajuan pending atau sedang dipinjam buku yang sama
    $existingBorrowing = Borrowing::where('user_id', auth()->id())
        ->where('book_id', $book->id)
        ->whereIn('status', ['pending', 'dipinjam'])
        ->first();

    if ($existingBorrowing) {
        return back()->with('error', 'Anda sudah memiliki pengajuan atau sedang meminjam buku ini.');
    }

    // Membuat pengajuan
    Borrowing::create([
        'user_id' => auth()->id(),
        'book_id' => $book->id,
        'status' => 'pending',
    ]);

    return redirect()->route('peminjam.borrowings.index')
        ->with('success', 'Pengajuan peminjaman telah dikirim. Menunggu ACC petugas.');
}


    // Menampilkan riwayat peminjaman sendiri
    public function index(Request $request)
{
    $userId = auth()->id();

    // 1. Statistik
    $activeBorrowingsCount = Borrowing::where('user_id', $userId)
        ->where('status', 'dipinjam')
        ->count();

    $totalBorrowingsCount = Borrowing::where('user_id', $userId)->count();

    $returnedCount = Borrowing::where('user_id', $userId)
        ->where('status', 'dikembalikan')
        ->count();

    $lateCount = Borrowing::where('user_id', $userId)
        ->where('status', 'terlambat')
        ->count();

    // 2. Buku yang sedang dipinjam
    $activeBorrowings = Borrowing::where('user_id', $userId)
        ->where('status', 'dipinjam')
        ->with('book.category')
        ->get();

    // 3. Filtering berdasarkan status untuk tabel riwayat
    $query = Borrowing::where('user_id', $userId)->with('book');

    if ($request->status == 'borrowed') {
        $query->where('status', 'dipinjam');
    } elseif ($request->status == 'returned') {
        $query->where('status', 'dikembalikan');
    }

    $borrowings = $query->latest()->paginate(10);

    return view('peminjam.borrowings.index', compact(
        'borrowings',
        'activeBorrowings',
        'activeBorrowingsCount',
        'totalBorrowingsCount',
        'returnedCount',
        'lateCount'
    ));
}


    // Method lainnya tidak diimplementasikan
    public function create() { abort(404); }
    public function show() { abort(404); }
    public function edit() { abort(404); }
    public function update() { abort(404); }
    public function destroy() { abort(404); }
}