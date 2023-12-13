@extends('dashboard.app')

@section('content')
<div class="card-body">
    <embed src="{{ 'data:application/pdf;base64,' . base64_encode($pdf->output()) }}" type="application/pdf" width="100%" height="500px" />
    {{-- <a href="{{ route('rab.edit', ['ID_RAB' => $rab->ID_RAB]) }}" class="btn btn-warning">Edit</a> --}}
    <div class="bi bi-download">
    <a href="{{ route('rab.preview.download', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan,'ID_RAB' => $rab->ID_RAB]) }}" class="btn btn-success">Unduh PDF</a>
    @if ($pengadaan->id_status_rab==7)
    <td class="badge badge-primary">
        <a href="{{ route('rab.kirim', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan,'ID_RAB' => $rab->ID_RAB]) }}" class="btn btn-primary">Kirim</a>
    </td>
    @else
    <td>
        <a style="display:none;"></a>
    </td>
    @endif
    <td>
        <a href="{{ route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan]) }}" class="btn btn-primary my-4">Kembali</a>
    </td>
</div>
</div>
@endsection

