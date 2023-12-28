{{-- @extends('dashboard/app')

@section('content')

<form action="{{ route('tanda_tangan.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="tanda_tangan" accept="image/*" required>
    <button type="submit">Perbarui Tanda Tangan</button>
</form>
@endsection --}}
@extends('dashboard/app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Perbarui Tanda Tangan</h2>
        </div>
        <div class="card-body">
            <p>Berikut adalah tanda tangan Anda. Silakan perbarui tanda tangan jika diperlukan.</p>

            <!-- Menampilkan tanda tangan yang sudah ada -->
            @if($tandaTangan)
                <img src="{{ asset('storage/'.$tandaTangan->path) }}" alt="Tanda Tangan" class="img-fluid" width="300">
            @else
                <!-- Pesan jika tanda tangan belum tersedia -->
                <p>Tanda tangan tidak tersedia.</p>
            @endif

            <br>
            <br>
            <!-- Form untuk mengunggah tanda tangan -->
            @if (!empty($tandaTangan->path))
            <form action="{{ route('tanda_tangan.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="tanda_tangan" class="form-label">Pilih File Tanda Tangan (Format: JPEG, PNG)</label>
                    <input type="file" class="form-control" name="tanda_tangan" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary">Perbarui Tanda Tangan</button>
            </form>
            @else
            Tanda Tangan Belum Tersedia Silahkan Klik <a href="/tanda_tangan/create">Upload</a>
            @endif
        </div>
    </div>
</div>
@endsection

