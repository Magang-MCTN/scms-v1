@extends('dashboard.app')

@section('content')
<div class="card-body">
    <embed src="{{ 'data:application/pdf;base64,' . base64_encode($pdf->output()) }}" type="application/pdf" width="100%" height="500px" />
    {{-- <a href="{{ route('rab.edit', ['ID_RAB' => $rab->ID_RAB]) }}" class="btn btn-warning">Edit</a> --}}
    <div class="bi bi-download">
    <a href="{{ route('rab.preview.download', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan,'ID_RAB' => $rab->ID_RAB]) }}" class="btn btn-success">Unduh PDF</a>
    <td class="badge badge-primary">
        <a href="{{ route('rab.kirim', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan,'ID_RAB' => $rab->ID_RAB]) }}" class="btn btn-primary">Kirim</a>
    </td>    
</div>
</div>
@endsection

