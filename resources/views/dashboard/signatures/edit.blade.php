@extends('dashboard/app')

@section('content')

<form action="{{ route('tanda_tangan.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="tanda_tangan" accept="image/*" required>
    <button type="submit">Perbarui Tanda Tangan</button>
</form>
@endsection
