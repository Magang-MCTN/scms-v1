@extends('dashboard.app')

@section('content')
<div class="card-body">
    <embed src="{{ 'data:application/pdf;base64,' . base64_encode($pdf->output()) }}" type="application/pdf" width="100%" height="500px" />
    {{-- <a href="{{ route('rab.edit', ['ID_RAB' => $rab->ID_RAB]) }}" class="btn btn-warning">Edit</a> --}}
    <div class="bi bi-download">
    <a href="{{ route('justifikasi.preview.download', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan,'ID_JPL' =>$justifikasi->ID_JPL]) }}" class="btn btn-success">Unduh PDF</a>
   @if ($pengadaan->id_status_justifikasi==7)
    <td class="badge badge-primary">
        <a href="{{ route('justifikasi.kirim', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan,'ID_JPL' => $justifikasi->ID_JPL]) }}" class="btn btn-primary">Kirim</a>
    </td>
    <td>
        <a href="{{ route('justifikasi.edit', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan,'ID_JPL' =>$justifikasi->ID_JPL]) }}" class="btn btn-warning">Edit</a>
    </td>
    @elseif ($pengadaan->id_status_justifikasi==2)
    <td>
        <a href="{{ route('justifikasi.edit', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan,'ID_JPL' =>$justifikasi->ID_JPL]) }}" class="btn btn-warning">Edit</a>
    </td>
    @else
    <td>
        <a style="display:none;"></a>
    </td>
    @endif
    <td>
        <button class="btn btn-primary my-4" onclick="goBack()">Kembali</button>
    </td>
    <div style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; text-align: left;">
        @if (!empty($pengadaan->alasan_justifikasi))
            <label for="alasan_justifikasi">Alasan Penyetujuan/Penolakan : <b>{{ $pengadaan->alasan_justifikasi }}</b></label>
        @endif
    </div>
    
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</div>
</div>
@endsection

