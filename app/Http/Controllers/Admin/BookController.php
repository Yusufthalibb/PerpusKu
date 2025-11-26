<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Menampilkan daftar buku
     */
    public function index()
    {
         $books = Book::with('category')->latest()->paginate(10);
    $categories = Category::all(); // ➜ Tambahkan ini

    return view('admin.books.index', compact('books', 'categories'));
    }

    /**
     * Form tambah buku
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    /**
     * Simpan buku baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'isbn'        => 'required|string|max:20|unique:books',
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'publisher'   => 'required|string|max:255',
            'year'        => 'required|integer|digits:4',
            'category_id' => 'required|exists:categories,id',
            'pages'       => 'required|integer|min:1',
            'shelf_code'  => 'required|string|max:20',
            'description' => 'nullable|string',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Upload image
        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $imageName  = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/books', $imageName);
            $data['image'] = 'books/' . $imageName;
        }

        Book::create($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Detail buku
     */
    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }

    /**
     * Form edit buku
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    /**
     * Update data buku
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'isbn'        => 'required|string|max:20|unique:books,isbn,' . $book->id,
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'publisher'   => 'required|string|max:255',
            'year'        => 'required|integer|digits:4',
            'category_id' => 'required|exists:categories,id',
            'pages'       => 'required|integer|min:1',
            'shelf_code'  => 'required|string|max:20',
            'description' => 'nullable|string',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Jika upload image baru
        if ($request->hasFile('image')) {

            // Hapus image lama jika ada
            if ($book->image && Storage::disk('public')->exists($book->image)) {
                Storage::disk('public')->delete($book->image);
            }

            $image      = $request->file('image');
            $imageName  = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/books', $imageName);
            $data['image'] = 'books/' . $imageName;
        }

        // Update data buku
        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Hapus buku
     */
    public function destroy(Book $book)
    {
        // Hapus image jika ada
        if ($book->image && Storage::disk('public')->exists($book->image)) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
}
