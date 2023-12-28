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
    <td>
        <a href="{{ route('rab.edit', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan,'ID_RAB' =>$rab->ID_RAB]) }}" class="btn btn-warning">Edit</a>
    </td>
    @endif
    @if (in_array($pengadaan->id_status_rab, [2]))
    <td>
        <a href="{{ route('rab.edit', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan,'ID_RAB' =>$rab->ID_RAB]) }}" class="btn btn-warning">Edit</a>
    </td>
    @else
    <td>
        <a style="display:none;"></a>
    </td>
    @endif
    <td>
        <a href="{{ route('pengadaan.detail', ['ID_Pengadaan' => $ID_Pengadaan]) }}" class="btn btn-primary my-4">Kembali</a>
        {{-- <button class="btn btn-primary my-4" onclick="goBack()">Kembali</button> --}}
    </td>
    <div style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; text-align: left;">
        @if (!empty($pengadaan->alasan_rab))
            <label for="alasan_rab">Alasan Penyetujuan/Penolakan : <b>{{ $pengadaan->alasan_rab }}</b></label>
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

