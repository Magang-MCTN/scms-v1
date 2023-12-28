@extends('dashboard/app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Unggah Tanda Tangan</h2>
        </div>
        <div class="card-body">
            <p>Berikut adalah tanda tangan Anda. Silakan unggah tanda tangan jika belum tersedia untuk kemudahan persetujuan.</p>

            <!-- Menampilkan tanda tangan yang sudah ada -->
            @if($tandaTangan)
                <img src="{{ asset('storage/'.$tandaTangan->path) }}" alt="Tanda Tangan" class="img-fluid" width="300">
            @else
                <!-- Pesan jika tanda tangan belum tersedia -->
                <p>Tanda tangan tidak tersedia.</p>
            @endif

            <br>

            <!-- Form untuk mengunggah tanda tangan -->
            @if (empty($tandaTangan->path))
            <form action="{{ route('tanda_tangan.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="tanda_tangan" class="form-label">Pilih File Tanda Tangan (Format: JPEG, PNG)</label>
                    <input type="file" class="form-control" name="tanda_tangan" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary">Unggah Tanda Tangan</button>
            </form>
            @else
            <br>
            Jika Ingin Memperbaharui Tanda Tangan Silahkan Klik <a href="/tanda_tangan/edit">Edit</a>
            @endif
        </div>
    </div>
</div>
@endsection
