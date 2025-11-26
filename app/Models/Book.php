<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'isbn',
        'title',
        'author',
        'publisher',
        'year',
        'category_id',
        'pages',
        'shelf_code',
        'description',
        'stock',
        'image',
        'status',
    ];

    /**
     * Relasi ke tabel Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke tabel Borrowings
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}