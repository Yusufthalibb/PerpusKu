<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Carbon\Carbon;

class ReportsExport implements FromView, WithTitle, ShouldAutoSize
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Mengembalikan view Blade yang akan dirender ke dalam Excel.
     * Ini memungkinkan penggunaan Blade untuk tata letak tabel yang kompleks.
     */
    public function view(): View
    {
        // View ini harus mencerminkan struktur laporan yang akan diekspor.
        // Saya akan menggunakan view yang sama dengan PDF untuk konsistensi.
        return view('petugas.reports.excel', [
            'data' => $this->data,
        ]);
    }

    /**
     * Mendefinisikan nama sheet di dalam file Excel.
     */
    public function title(): string
    {
        return 'Laporan Perpustakaan';
    }
}