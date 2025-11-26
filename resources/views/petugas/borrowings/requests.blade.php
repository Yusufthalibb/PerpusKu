@extends('layouts.petugas')

@section('content')
<h3>Pengajuan peminjaman Buku</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>peminjam</th>
            <th>Buku</th>
            <th>Tanggal Pengajuan</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($borrowings as $b)
        <tr>
            <td>{{ $b->user->name }}</td>
            <td>{{ $b->book->title }}</td>
            <td>{{ $b->created_at->format('d M Y H:i') }}</td>

            <td class="d-flex gap-1">
                <!-- ACC -->
                <form action="{{ route('petugas.borrowings.approve', $b->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-success btn-sm">ACC</button>
                </form>

                <!-- Tolak -->
                <form action="{{ route('petugas.borrowings.reject', $b->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-sm">Tolak</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $borrowings->links() }}
@endsection
