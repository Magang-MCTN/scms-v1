@extends('dashboard.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-2">
            <div class="card-header">{{ __('Daftar Pengajuan Pengadaan Barang/Jasa') }}</div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3>Nama Pekerjaan: {{ $pengadaan->Judul_Pengadaan }}</h3>
                    </div>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>Nama Dokumen</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(['Nota Dinas Permintaan Pengadaan', 'HPE', 'RKS', 'Ringkasan RKS', 'Dokumen Kualifikasi'] as $dokumen)
                                @if ($dokumen_checked2[$dokumen])
                                    @php
                                        $tanggalPengajuan = optional($pengadaan->{'tanggal_' . strtolower(str_replace(' ', '_', $dokumen))})->tanggal_pengajuan ?? null;
                                        $status = null;
                                        if ($dokumen == 'Nota Dinas Permintaan Pengadaan' && $statusNotaDinasPermintaan && in_array($statusNotaDinasPermintaan->id_status, [2,3,11, 12, 13 , 14, 15, 16, 17])) {
                                            $status = $statusNotaDinasPermintaan->keterangan_status;
                                        } elseif ($dokumen == 'HPE' && $statusHPE && in_array($statusHPE->id_status, [2, 4, 11, 12, 13 , 14, 15, 16, 17])) {
                                            $status = $statusHPE->keterangan_status;
                                        } elseif ($dokumen == 'RKS' && $statusRKS && in_array($statusRKS->id_status, [2,4, 11, 12, 13 , 14, 15, 16, 17])) {
                                            $status = $statusRKS->keterangan_status;
                                        } elseif ($dokumen == 'Ringkasan RKS' && $statusRingkasanRKS && in_array($statusRingkasanRKS->id_status, [2,4, 11, 12, 13 , 14, 15, 16, 17])) {
                                            $status = $statusRingkasanRKS->keterangan_status;
                                        } elseif ($dokumen == 'Dokumen Kualifikasi' && $statusDokumenKualifikasi && in_array($statusDokumenKualifikasi->id_status, [2,4,11, 12, 13 , 14, 15, 16, 17])) {
                                            $status = $statusDokumenKualifikasi->keterangan_status;
                                        }
                                    @endphp
                                @if ($status)
                                <tr>
                                    <td>{{ $dokumen }}</td>
                                    <td>
                                        @if ($dokumen == 'Nota Dinas Permintaan Pengadaan')
                                            @if ($notaDinasPermintaan)
                                                {{ $notaDinasPermintaan->tanggal_pengajuan }}
                                            @endif
                                        @elseif ($dokumen == 'HPE')
                                            @if ($hpe)
                                                {{ $hpe->tanggal_pengajuan }}
                                            @endif
                                        @elseif ($dokumen == 'RKS')
                                            @if ($rks)
                                                {{ $rks->tanggal_pengajuan }}
                                            @endif
                                        @elseif ($dokumen == 'Ringkasan RKS')
                                            @if ($ringkasanRKS)
                                                {{ $rks->tanggal_pengajuan }}
                                            @endif
                                        @elseif ($dokumen == 'Dokumen Kualifikasi')
                                            @if ($dokumenKualifikasi)
                                                {{ $dokumenKualifikasi->tanggal_pengajuan }}
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if ($dokumen == 'Nota Dinas Permintaan Pengadaan')
                                                    @if ($statusNotaDinasPermintaan)
                                                        @if ($statusNotaDinasPermintaan->id_status == 2 || $statusNotaDinasPermintaan->id_status == 15)
                                                            <span class="badge badge-danger">{{ $statusNotaDinasPermintaan->keterangan_status }}</span>
                                                        @elseif ($statusNotaDinasPermintaan->id_status == 3 || $statusNotaDinasPermintaan->id_status == 4 || $statusNotaDinasPermintaan->id_status == 5 || $statusNotaDinasPermintaan->id_status == 12)
                                                            <span class="badge badge-success">{{ $statusNotaDinasPermintaan->keterangan_status }}</span>
                                                        @else
                                                            <span class="badge badge-warning">{{ $statusNotaDinasPermintaan->keterangan_status }}</span>
                                                        @endif
                                                    @else
                                                        Status Tidak Ditemukan
                                                    @endif
                                                @elseif ($dokumen == 'Nota Dinas Permintaan Pelaksanaan Pengadaan')
                                                    @if ($statusNotaDinasPelaksanaan)
                                                        @if ($statusNotaDinasPelaksanaan->id_status == 2 || $statusNotaDinasPelaksanaan->id_status == 15)
                                                            <span class="badge badge-danger">{{ $statusNotaDinasPelaksanaan->keterangan_status }}</span>
                                                        @elseif ($statusNotaDinasPelaksanaan->id_status == 3 || $statusNotaDinasPelaksanaan->id_status == 4 || $statusNotaDinasPelaksanaan->id_status == 5 || $statusNotaDinasPelaksanaan->id_status == 12)
                                                            <span class="badge badge-success">{{ $statusNotaDinasPelaksanaan->keterangan_status }}</span>
                                                        @else
                                                            <span class="badge badge-warning">{{ $statusNotaDinasPelaksanaan->keterangan_status }}</span>
                                                        @endif
                                                    @else
                                                        Status Tidak Ditemukan
                                                    @endif
                                                @elseif ($dokumen == 'HPE')
                                                    @if ($statusHPE)
                                                        @if ($statusHPE->id_status == 2 || $statusHPE->id_status == 15)
                                                            <span class="badge badge-danger">{{ $statusHPE->keterangan_status }}</span>
                                                        @elseif ($statusHPE->id_status == 3 || $statusHPE->id_status == 4 || $statusHPE->id_status == 5 || $statusHPE->id_status == 12)
                                                            <span class="badge badge-success">{{ $statusHPE->keterangan_status }}</span>
                                                        @else
                                                            <span class="badge badge-warning">{{ $statusHPE->keterangan_status }}</span>
                                                        @endif
                                                    @else
                                                        Status Tidak Ditemukan
                                                    @endif
                                                @elseif ($dokumen == 'RKS')
                                                    @if ($statusRKS)
                                                        @if ($statusRKS->id_status == 2 || $statusRKS->id_status == 15)
                                                            <span class="badge badge-danger">{{ $statusRKS->keterangan_status }}</span>
                                                        @elseif ($statusRKS->id_status == 3 || $statusRKS->id_status == 4 || $statusRKS->id_status == 5 || $statusRKS->id_status == 12)
                                                            <span class="badge badge-success">{{ $statusRKS->keterangan_status }}</span>
                                                        @else
                                                            <span class="badge badge-warning">{{ $statusRKS->keterangan_status }}</span>
                                                        @endif
                                                    @else
                                                        Status Tidak Ditemukan
                                                    @endif
                                                @elseif ($dokumen == 'Ringkasan RKS')
                                                    @if ($statusRingkasanRKS)
                                                        @if ($statusRingkasanRKS->id_status == 2 || $statusRingkasanRKS->id_status == 15)
                                                            <span class="badge badge-danger">{{ $statusRingkasanRKS->keterangan_status }}</span>
                                                        @elseif ($statusRingkasanRKS->id_status == 3 || $statusRingkasanRKS->id_status == 4 || $statusRingkasanRKS->id_status == 5 || $statusRingkasanRKS->id_status == 12)
                                                            <span class="badge badge-success">{{ $statusRingkasanRKS->keterangan_status }}</span>
                                                        @else
                                                            <span class="badge badge-warning">{{ $statusRingkasanRKS->keterangan_status }}</span>
                                                        @endif
                                                    @else
                                                        Status Tidak Ditemukan
                                                    @endif
                                                @elseif ($dokumen == 'Dokumen Kualifikasi')
                                                    @if ($statusDokumenKualifikasi)
                                                        @if ($statusDokumenKualifikasi->id_status == 2 || $statusDokumenKualifikasi->id_status == 15)
                                                            <span class="badge badge-danger">{{ $statusDokumenKualifikasi->keterangan_status }}</span>
                                                        @elseif ($statusDokumenKualifikasi->id_status == 3 || $statusDokumenKualifikasi->id_status == 4 || $statusDokumenKualifikasi->id_status == 5 || $statusDokumenKualifikasi->id_status == 12)
                                                            <span class="badge badge-success">{{ $statusDokumenKualifikasi->keterangan_status }}</span>
                                                        @else
                                                            <span class="badge badge-warning">{{ $statusDokumenKualifikasi->keterangan_status }}</span>
                                                        @endif
                                                    @else
                                                        Status Tidak Ditemukan
                                                    @endif
                                                @endif
                                            </td>    
                                    <td>
                                        @if ($dokumen == 'Nota Dinas Permintaan Pengadaan')
                                            @if (in_array($statusNotaDinasPermintaan->id_status, [2, 3, 11, 12, 13 , 14, 15, 16, 17]))
                                                <a href="{{ route('pejabatrendan.detail', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan]) }}" class="btn btn-info">Detail</a>
                                            @endif
                                        @elseif ($dokumen == 'HPE')
                                            @if (in_array($statusHPE->id_status, [2, 4, 11, 13, 12 , 14, 15, 16, 17]))
                                                <a href="{{ route('pejabatrendan.approve.hpe', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan, 'ID_HPE' => $hpe->ID_HPE]) }}" class="btn btn-info">Detail</a>
                                            @endif
                                        @elseif ($dokumen == 'RKS')
                                            @if (in_array($statusRKS->id_status, [2,4,11, 12, 13 , 14, 15, 16, 17]))
                                            <a href="{{ route('rks.preview', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan, 'ID_Ringkasan_Rks' => $rks->ID_Ringkasan_Rks]) }}" class="btn btn-info" target="blank">Detail</a>
                                            @endif
                                        @elseif ($dokumen == 'Ringkasan RKS')
                                            @if (in_array($statusRingkasanRKS->id_status, [2,4,11, 12, 13 , 14, 15, 16, 17]))
                                                <a href="{{ route('pejabatrendan.approve.rks', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan, 'ID_Ringkasan_Rks' => $rks->ID_Ringkasan_Rks]) }}" class="btn btn-info">Detail</a>
                                            @endif
                                        @elseif ($dokumen == 'Dokumen Kualifikasi')
                                            @if (in_array($statusDokumenKualifikasi->id_status, [2,4,11, 12, 13 , 14, 15, 16, 17]))
                                                <a href="{{ route('dokumen.preview', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan, 'ID_Dokumen_Kualifikasi' => $dokumenKualifikasi->ID_Dokumen_Kualifikasi]) }}" class="btn btn-info" target="blank">Detail</a>
                                            @endif
                                        @endif
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
