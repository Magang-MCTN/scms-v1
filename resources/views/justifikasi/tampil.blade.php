@extends('dashboard.app')

@section('content')
<div class="card-body">
    <embed src="{{ 'data:application/pdf;base64,' . base64_encode($pdf->output()) }}" type="application/pdf" width="100%" height="500px" />
    {{-- <a href="{{ route('rab.edit', ['ID_RAB' => $rab->ID_RAB]) }}" class="btn btn-warning">Edit</a> --}}
    <div class="bi bi-download">
    <a href="{{ route('justifikasi.preview.download', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan,'ID_JPL' =>$justifikasi->ID_JPL]) }}" class="btn btn-success">Unduh PDF</a>
    <td class="badge badge-primary">
        <a href="{{ route('justifikasi.kirim', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan,'ID_JPL' => $justifikasi->ID_JPL]) }}" class="btn btn-primary">Kirim</a>
    </td>
    <td>
        <a href="{{ route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan]) }}" class="btn btn-primary my-4">Kembali</a>
    </td>
</div>
</div>
@endsection

