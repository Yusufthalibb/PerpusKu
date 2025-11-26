<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    // ... Salin semua method dari Admin/BookController.php di sini ...
    // Pastikan mengubah 'admin.' menjadi 'petugas.' pada route redirect dan view

    public function index()
    {
        $books = Book::with('category')->latest()->paginate(10);
        return view('petugas.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('petugas.books.create', compact('categories'));
    }

    public function store(Request $request)
    {

        // ... salin kode store dari Admin ...
        $request->validate([
            'isbn' => 'required|string|max:20|unique:books',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|digits:4',
            'category_id' => 'required|exists:categories,id',
            'pages' => 'required|integer|min:1',
            'shelf_code' => 'required|string|max:20',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/books', $imageName);
            $data['image'] = 'books/' . $imageName;
        }

        Book::create($data);

        return redirect()->route('petugas.books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show(Book $book)
    {
        return view('petugas.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('petugas.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        // ... salin kode update dari Admin ...
        $request->validate([
            'isbn' => 'required|string|max:20|unique:books,isbn,' . $book->id,
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|digits:4',
            'category_id' => 'required|exists:categories,id',
            'pages' => 'required|integer|min:1',
            'shelf_code' => 'required|string|max:20',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($book->image && Storage::disk('public')->exists($book->image)) {
                Storage::disk('public')->delete($book->image);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/books', $imageName);
            $data['image'] = 'books/' . $imageName;
        }

        $book->update($data);

        return redirect()->route('petugas.books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(Book $book)
    {
        // ... salin kode destroy dari Admin ...
        if ($book->image && Storage::disk('public')->exists($book->image)) {
            Storage::disk('public')->delete($book->image);
        }
        $book->delete();
        return redirect()->route('petugas.books.index')->with('success', 'Buku berhasil dihapus!');
    }
}