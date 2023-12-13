@extends('dashboard.app')

@section('content')
<div class="card-body">
    <embed src="{{ 'data:application/pdf;base64,' . base64_encode($pdf->output()) }}" type="application/pdf" width="100%" height="500px" />
    <div class="bi bi-download">
    <a href="{{ route('nota_dinas_permintaan.preview.download', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan,'id_nota_dinas_permintaan' => $notaDinasPermintaan->id_nota_dinas_permintaan]) }}" class="btn btn-success">Unduh PDF</a>
    <td class="d-flex my-4">
        @if($pengadaan->id_status_nota_dinas_permintaan === 8)
            <button id="btn-approve" class="btn btn-success mx-2">Setuju</button>
        @endif

        @if($pengadaan->id_status_nota_dinas_permintaan === 8)
            <button id="btn-reject" class="btn btn-danger mx-2">Tolak</button>
        @endif
    </td>
    <div id="alasan-form" style="display: none;">
        <form action="{{ route('pejabatuser.approve-nota-dinas-permintaan', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan,'id_nota_dinas_permintaan' => $notaDinasPermintaan->id_nota_dinas_permintaan]) }}" method="POST">
            @csrf
            <div class="my-3 me-3">
                <label for="alasan_nota_dinas_permintaan">Alasan Setuju:</label>
            </div>
            <textarea name="alasan_nota_dinas_permintaan" id="alasan_nota_dinas_permintaan" cols="40" rows="5" style="border-radius: 5px"required></textarea><br>
            <button type="submit" class="btn btn-success my-2">Setuju</button>
        </form>
    </div>

    <div id="alasan-tolak-form" style="display: none;">
        <form action="{{ route('pejabatuser.reject-nota-dinas-permintaan', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan,'id_nota_dinas_permintaan' => $notaDinasPermintaan->id_nota_dinas_permintaan]) }}" method="POST">
            @csrf
            <div class="my-3 me-3">
                <label for="alasan_nota_dinas_permintaan">Alasan Tolak:</label>
            </div>
            <textarea name="alasan_nota_dinas_permintaan" id="alasan_nota_dinas_permintaan" cols="40" rows="5" style="border-radius: 5px" required></textarea><br>
            <button type="submit" class="btn btn-danger my-2">Tolak</button>
        </form>
    </div>
    <td>
        <a href="{{ route('pejabatuser.detail', ['ID_Pengadaan' => $ID_Pengadaan]) }}" class="btn btn-primary my-4">Kembali</a>
    </td>
</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnApprove = document.getElementById('btn-approve');
        const btnReject = document.getElementById('btn-reject');
        const alasanForm = document.getElementById('alasan-form');
        const alasanTolakForm = document.getElementById('alasan-tolak-form');

        btnApprove.addEventListener('click', function(e) {
            e.preventDefault();
            if (alasanForm.style.display === 'block') {
                alasanForm.style.display = 'none';
            } else {
                alasanForm.style.display = 'block';
                alasanTolakForm.style.display = 'none';
            }
        });

        btnReject.addEventListener('click', function(e) {
            e.preventDefault();
            if (alasanTolakForm.style.display === 'block') {
                alasanTolakForm.style.display = 'none';
            } else {
                alasanTolakForm.style.display = 'block';
                alasanForm.style.display = 'none';
            }
        });
    });
</script>
@endsection

