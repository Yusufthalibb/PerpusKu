<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\BorrowingController as AdminBorrowingController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\peminjam\BookController as peminjamBookController;
use App\Http\Controllers\peminjam\BorrowingController as peminjamBorrowingController;
use App\Http\Controllers\peminjam\DashboardController as peminjamDashboardController;
use App\Http\Controllers\peminjam\ProfileController as peminjamProfileController;
use App\Http\Controllers\Petugas\BookController as PetugasBookController;
use App\Http\Controllers\Petugas\ProfileController as PetugasProfileController;
use App\Http\Controllers\Petugas\BorrowingController as PetugasBorrowingController;
use App\Http\Controllers\Petugas\CategoryController as PetugasCategoryController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\ReportController as PetugasReportController;
use Illuminate\Support\Facades\Route;

// -------------------------------------------------
// ROUTE UNTUK UMUM (GUEST)
Route::get('/', function () { return view('home'); })->name('home');
   Route::get('/fitur', function () { return view('fitur'); })->name('fitur');
   Route::get('/katalog', function () { return view('katalog'); })->name('fitur');
   Route::get('/panduan', function () { return view('panduan'); })->name('panduan');
   Route::get('/testimoni', function () { return view('testimoni'); })->name('testimoni');
   Route::get('/partner', function () { return view('partner'); })->name('partner');
   Route::get('/faq', function () { return view('faq'); })->name('faq');
   Route::get('/login', function () { return view('auth.login'); })->name('login');


// Katalog buku publik
Route::get('/books', [peminjamBookController::class, 'publicCatalog'])->name('books.public');

// Route Breeze untuk autentikasi
require __DIR__.'/auth.php';

// -------------------------------------------------
// ROUTE YANG MEMBUTUHKAN LOGIN
// -------------------------------------------------
Route::middleware('auth')->group(function () {
    // Dashboard dinamis
    Route::get('/dashboard', function () {
        if (auth()->user()->role == 'admin') { return redirect()->route('admin.dashboard'); }
        elseif (auth()->user()->role == 'petugas') { return redirect()->route('petugas.dashboard'); }
        else { return redirect()->route('peminjam.dashboard'); }
    })->name('dashboard');

    // -------------------------------------------------
    // ROUTE GROUP UNTUK ADMIN
    // -------------------------------------------------
    Route::middleware('isAdmin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('/users', AdminUserController::class);
        Route::resource('/books', AdminBookController::class);
        Route::resource('/categories', AdminCategoryController::class);
        Route::get('/borrowings', [AdminBorrowingController::class, 'index'])->name('borrowings.index');
        
        // ROUTE UNTUK LAPORAN
        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/export/excel', [AdminReportController::class, 'exportExcel'])->name('reports.export.excel'); // <-- Tambahan
        Route::get('/reports/export/pdf', [AdminReportController::class, 'exportPdf'])->name('reports.export.pdf'); // <-- Tambahan

        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [AdminSettingController::class, 'store'])->name('settings.store');
        Route::get('/profile', [AdminUserController::class, 'profile'])->name('profile');
        Route::put('/profile', [AdminUserController::class, 'updateProfile'])->name('profile.update');
        Route::put('/profile/password', [AdminUserController::class, 'updatePassword'])->name('profile.update.password');

    });

    // -------------------------------------------------
    // ROUTE GROUP UNTUK PETUGAS
    Route::middleware('isPetugas')->prefix('petugas')->name('petugas.')->group(function () {
        Route::get('/borrowings/requests', [PetugasBorrowingController::class, 'requests'])
            ->name('borrowings.requests');
        Route::post('/borrowings/{borrowing}/approve', [PetugasBorrowingController::class, 'approve'])
            ->name('borrowings.approve');
        Route::post('/borrowings/{borrowing}/reject', [PetugasBorrowingController::class, 'reject'])
            ->name('borrowings.reject');
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');
        Route::resource('/books', PetugasBookController::class);
        Route::resource('/categories', PetugasCategoryController::class);
        Route::get('/borrowings/history', [PetugasBorrowingController::class, 'history'])->name('borrowings.history');
        Route::get('/users/{user}/profile', [PetugasBorrowingController::class, 'showUserProfile'])->name('users.profile');
        Route::resource('/borrowings', PetugasBorrowingController::class);
        
        // ROUTE UNTUK LAPORAN
        Route::get('/reports', [PetugasReportController::class, 'index'])->name('reports.index');
        // Rute untuk Ekspor PDF/Excel Laporan Petugas (Ditambahkan di sini)
        Route::get('/reports/export/{type}', [PetugasReportController::class, 'export'])->name('reports.export'); 

        Route::get('/profile', [PetugasProfileController::class, 'profile'])->name('profile');
        Route::put('/profile', [PetugasProfileController::class, 'updateProfile'])->name('profile.update');
        Route::put('/profile/password', [PetugasBorrowingController::class, 'updatePassword'])->name('profile.update.password');
    });

    
    // route peminjam!!
    Route::middleware('ispeminjam')->prefix('peminjam')->name('peminjam.')->group(function () {
        Route::get('/dashboard', [peminjamDashboardController::class, 'index'])->name('dashboard');
        Route::get('/books', [peminjamBookController::class, 'index'])->name('books.index');
        Route::get('/books/{book}', [peminjamBookController::class, 'show'])->name('books.show');
        Route::post('/borrow/{book}', [peminjamBorrowingController::class, 'store'])->name('borrow.store');
        Route::get('/borrowings', [peminjamBorrowingController::class, 'index'])->name('borrowings.index');
        Route::get('/profile', [peminjamProfileController::class, 'profile'])->name('profile');
        Route::put('/profile', [peminjamProfileController::class, 'updateProfile'])->name('profile.update');
    });
});