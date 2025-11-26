<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class Borrowing extends Model
{
    use HasFactory;

   protected $fillable = [
    'user_id',
    'book_id',
    'borrow_date',
    'return_date',
    'actual_return_date',
    'status',
    'fine',
];


    /**
     * Relasi ke tabel User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke tabel Book
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function scopeFilter($query, $request)
{
    // Filter berdasarkan nama user
    if ($request->filled('user')) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->user . '%');
        });
    }

    // Filter berdasarkan judul buku
    if ($request->filled('book')) {
        $query->whereHas('book', function ($q) use ($request) {
            $q->where('judul', 'like', '%' . $request->book . '%');
        });
    }

    // Filter berdasarkan tanggal
    if ($request->filled('tanggal')) {
        $query->whereDate('created_at', $request->tanggal);
    }

    // Filter berdasarkan status (dikembalikan, terlambat, dll)
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    return $query;
}

protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        if (!$model->status) {
            $model->status = 'pending';
        }
    });
}


}