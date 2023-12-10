@extends('dashboard/app')

@section('content')
<div><p> Berikut adalah Tanda tangan anda Silahkan Upload tanda tangan
   <br> jika belum tersedia untuk kemudahan aproval</p>
    <br></div><br>
<!-- Form untuk mengunggah tanda tangan -->
<!-- Form untuk mengunggah atau menampilkan tanda tangan -->
<form action="{{ route('tanda_tangan.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    {{-- @php
    use App\Models\Signatures;
        $user = auth()->user();
        $tandaTangan = Signatures::where('id_user', $user->id)->first();
@endphp --}}

@if($tandaTangan)
    <!-- Menampilkan tanda tangan yang sudah ada -->
    <img src="{{ asset('storage/'.$tandaTangan->path) }}" alt="Tanda Tangan" width="200" height="auto">
@else
    <!-- Pesan jika tanda tangan belum tersedia -->
    <p>Tanda tangan tidak tersedia.</p>
@endif<br>
    <input type="file" name="tanda_tangan" accept="image/*" required>
    <button type="submit">Unggah Tanda Tangan</button>
</form>
@endsection
