<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relasi ke tabel Books
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
    public function borrowings()
{
    return $this->hasManyThrough(
        \App\Models\Borrowing::class,
        \App\Models\Book::class,
        'category_id', // foreign key di tabel books
        'book_id',     // foreign key di tabel borrowings
        'id',          // primary key categories
        'id'           // primary key books
    );
}

}