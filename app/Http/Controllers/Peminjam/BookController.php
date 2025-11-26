<?php

namespace App\Http\Controllers\peminjam;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Borrowing;

class BookController extends Controller
{
    /**
     * Menampilkan katalog buku untuk peminjam
     */
    public function index(Request $request)
    {
        $books = Book::with('category')
            ->where('stock', '>', 0); // hanya buku yang masih tersedia

        $categories = Category::all();

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;

            $books->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                      ->orWhere('author', 'like', "%$search%");
            });
        }

        // Filter kategori
        if ($request->filled('category_id')) {
            $books->where('category_id', $request->category_id);
        }

        $books = $books->latest()->paginate(12);

        return view('peminjam.books.index', compact('books', 'categories'));
    }

    /**
     * Menampilkan detail buku
     */
    public function show(Book $book)
    {
        // Cek apakah user sudah meminjam buku ini dan statusnya masih aktif
        $hasActiveBorrowing = Borrowing::where('book_id', $book->id)
            ->where('user_id', auth()->id())
            ->where('status', 'borrowed') // sesuaikan dengan status tabel kamu
            ->exists();

        return view('peminjam.books.show', compact('book', 'hasActiveBorrowing'));
    }

    /**
     * peminjam tidak boleh create / edit / delete
     */
    public function create()  { abort(404); }
    public function store()   { abort(404); }
    public function edit()    { abort(404); }
    public function update()  { abort(404); }
    public function destroy() { abort(404); }
}
