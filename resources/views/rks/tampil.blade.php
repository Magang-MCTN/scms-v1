@extends('dashboard.app')

@section('content')
<div class="card-body">
    <embed src="{{ 'data:application/pdf;base64,' . base64_encode($pdf->output()) }}" type="application/pdf" width="100%" height="500px" />
    {{-- <a href="{{ route('rab.edit', ['ID_RAB' => $rab->ID_RAB]) }}" class="btn btn-warning">Edit</a> --}}
    <div class="bi bi-download">
    <a href="{{ route('ringkasan.preview.download', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan,'ID_Ringkasan_Rks' =>$rks->ID_Ringkasan_Rks]) }}" class="btn btn-success">Unduh PDF</a>
   @if ($pengadaan->id_status_ringkasan_rks==7)
    <td class="badge badge-primary">
        <a href="{{ route('ringkasan.kirim', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan,'ID_Ringkasan_Rks' => $rks->ID_Ringkasan_Rks]) }}" class="btn btn-primary">Kirim</a>
    </td>
    @else
    <td>
        <a style="display:none;"></a>
    </td>
    @endif
    <td>
        <button class="btn btn-primary my-4" onclick="goBack()">Kembali</button>
    </td>
    
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</div>
</div>
@endsection

