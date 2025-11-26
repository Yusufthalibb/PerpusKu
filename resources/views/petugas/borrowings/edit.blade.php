{{-- resources/views/petugas/borrowings/edit.blade.php --}}
@extends('layouts.petugas')

@section('title', 'Proses Pengembalian')
@section('page-title', 'Proses Pengembalian')

@section('content')
<div class="page-header">
    <h2>Proses Pengembalian Buku</h2>
    <a href="{{ route('petugas.borrowings.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="detail-container">
    <div class="detail-card">
        <h3>Informasi peminjaman</h3>
        <table class="detail-table">
            <tr>
                <th>peminjam</th>
                <td>{{ $borrowing->user->name }}</td>
            </tr>
            <tr>
                <th>Buku</th>
                <td>{{ $borrowing->book->title }}</td>
            </tr>
            <tr>
                <th>Tanggal Pinjam</th>
                <td>{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Tenggat Kembali</th>
                <td>{{ \Carbon\Carbon::parse($borrowing->due_date)->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    @if(\Carbon\Carbon::parse($borrowing->due_date)->isPast())
                        <span class="badge badge-danger">Terlambat {{ \Carbon\Carbon::parse($borrowing->due_date)->diffInDays() }} hari</span>
                    @else
                        <span class="badge badge-success">Tepat Waktu</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="form-container">
        <form method="POST" action="{{ route('petugas.borrowings.update', $borrowing->id) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="return_date">Tanggal Kembali <span class="required">*</span></label>
                <input type="date" name="return_date" id="return_date" value="{{ old('return_date', date('Y-m-d')) }}" required>
                @error('return_date')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="fine">Denda (Rp)</label>
                <input type="number" name="fine" id="fine" value="{{ old('fine', 0) }}" min="0">
                <small>Kosongkan jika tidak ada denda</small>
                @error('fine')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="condition">Kondisi Buku <span class="required">*</span></label>
                <select name="condition" id="condition" required>
                    <option value="good" {{ old('condition') == 'good' ? 'selected' : '' }}>Baik</option>
                    <option value="damaged" {{ old('condition') == 'damaged' ? 'selected' : '' }}>Rusak</option>
                    <option value="lost" {{ old('condition') == 'lost' ? 'selected' : '' }}>Hilang</option>
                </select>
                @error('condition')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="notes">Catatan</label>
                <textarea name="notes" id="notes" rows="3">{{ old('notes') }}</textarea>
                @error('notes')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Proses Pengembalian</button>
                <a href="{{ route('petugas.borrowings.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection