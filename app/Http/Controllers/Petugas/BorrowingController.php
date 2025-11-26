<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    // Menampilkan form peminjaman
    public function create()
    {
        $users = User::where('role', 'peminjam')->get();
        $books = Book::where('stock', '>', 0)->get();
        return view('petugas.borrowings.create', compact('users', 'books'));
    }

    // Memproses peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'return_date' => 'required|date|after_or_equal:today',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock < 1) {
            return back()->with('error', 'Stok buku "' . $book->title . '" habis.');
        }

        Borrowing::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrow_date' => now()->toDateString(),
            'return_date' => $request->return_date,
        ]);

        $book->decrement('stock');

        return redirect()->route('petugas.borrowings.index')->with('success', 'Buku berhasil dipinjamkan!');
    }

    // Daftar transaksi peminjaman aktif
    public function index()
    {
        $borrowings = Borrowing::with('user', 'book')
            ->where('status', 'dipinjam')
            ->latest()
            ->paginate(10);
        return view('petugas.borrowings.index', compact('borrowings'));
    }

    // Menampilkan detail transaksi
    public function show(Borrowing $borrowing)
    {
        return view('petugas.borrowings.show', compact('borrowing'));
    }

    // Form untuk mengembalikan buku
    public function edit(Borrowing $borrowing)
    {
        // Hanya bisa edit jika status masih dipinjam
        if ($borrowing->status !== 'dipinjam') {
            return back()->with('error', 'Transaksi ini sudah selesai.');
        }
        return view('petugas.borrowings.edit', compact('borrowing'));
    }

    // Memproses pengembalian buku
    public function update(Request $request, Borrowing $borrowing)
    {
        if ($borrowing->status !== 'dipinjam') {
            return back()->with('error', 'Transaksi ini sudah selesai.');
        }

        $borrowing->actual_return_date = now()->toDateString();
        $fine = 0;

        if (now()->greaterThan($borrowing->return_date)) {
            $daysLate = now()->diffInDays($borrowing->return_date);
            $fine = $daysLate * 1000; // Denda 1000 per hari
            $borrowing->status = 'terlambat';
        } else {
            $borrowing->status = 'dikembalikan';
        }

        $borrowing->fine = $fine;
        $borrowing->save();

        $borrowing->book->increment('stock');

        return redirect()->route('petugas.borrowings.index')->with('success', 'Buku berhasil dikembalikan!' . ($fine > 0 ? ' Denda keterlambatan: Rp ' . number_format($fine, 0, ',', '.') : ''));
    }

    // Menampilkan riwayat semua peminjaman
    public function history(Request $request)
    {
        $borrowings = Borrowing::with('user', 'book')
            ->where('status', '!=', 'dipinjam')
            ->latest()
            ->filter($request) // Akan kita buat scope filter di model Borrowing
            ->paginate(10);

        return view('petugas.borrowings.history', compact('borrowings'));
    }

    // Menampilkan profil peminjam (read-only)
    public function showUserProfile(User $user)
    {
        if ($user->role !== 'peminjam') {
            return back()->with('error', 'User bukan peminjam.');
        }
        $user->load('borrowings.book');
        return view('petugas.users.profile', compact('user'));
    }

    // Method destroy tidak kita pakai untuk borrowing
    public function destroy(Borrowing $borrowing)
    {
        // Redirect ke index atau beri pesan error
        return redirect()->route('petugas.borrowings.index');
    }
    public function requests()
{
    $borrowings = Borrowing::with('user', 'book')
        ->where('status', 'pending')
        ->latest()
        ->paginate(10);

    return view('petugas.borrowings.requests', compact('borrowings'));
}
public function approve(Borrowing $borrowing)
{
    $book = $borrowing->book;

    if ($book->stock < 1) {
        return back()->with('error', 'Stok buku habis.');
    }

    $borrowing->update([
        'status' => 'dipinjam',
        'borrow_date' => now(),
        'return_date' => now()->addDays(7)->toDateString(),
    ]);

    $book->decrement('stock');

    return back()->with('success', 'Pengajuan disetujui dan buku berhasil dipinjam.');
}
public function reject(Borrowing $borrowing)
{
    $borrowing->update([
        'status' => 'ditolak'
    ]);

    return back()->with('success', 'Pengajuan peminjaman ditolak.');
}

}