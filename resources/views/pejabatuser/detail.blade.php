<!-- resources/views/pejabatuser/detail.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <h2>Detail Pengadaan Barang/Jasa</h2>
                    <p>Nama Pekerjaan: {{ $pengadaans->Judul_Pengadaan }}</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Dokumen</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(['Rencana Anggaran Biaya', 'Justifikasi Penunjukan Langsung', 'Nota Dinas Permintaan Pengadaan'] as $dokumen)
                                @if ($dokumen_checked[$dokumen])
                                    @php
                                        $tanggalPengajuan = optional($pengadaans->{'tanggal_' . strtolower(str_replace(' ', '_', $dokumen))})->tanggal_pengajuan ?? null;
                                        $status = null;

                                        if ($dokumen == 'Rencana Anggaran Biaya' && $statusRab && in_array($statusRab->id_status, [8, 9])) {
                                            $status = $statusRab->keterangan_status;
                                        } elseif ($dokumen == 'Justifikasi Penunjukan Langsung' && $statusJustifikasi && in_array($statusJustifikasi->id_status, [8, 9])) {
                                            $status = $statusJustifikasi->keterangan_status;
                                        } elseif ($dokumen == 'Nota Dinas Permintaan Pengadaan' && $statusNotaDinasPermintaan && in_array($statusNotaDinasPermintaan->id_status, [8, 9])) {
                                            $status = $statusNotaDinasPermintaan->keterangan_status;
                                        }
                                    @endphp

                                    @if ($status)
                                        <tr>
                                            <td>{{ $dokumen }}</td>
                                            <td>Tanggal Pengajuan: {{ $tanggalPengajuan }}</td>
                                            <td class="badge badge-pill badge-dark">{{ $status }}</td>
                                            <td>
                                                {{-- Aksi --}}
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
