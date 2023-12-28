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
                            @foreach(['Rencana Anggaran Biaya', 'Justifikasi Penunjukan Langsung', 'Nota Dinas Permintaan Pengadaan','Nota Dinas Permintaan Pelaksanaan Pengadaan', 'HPE', 'RKS', 'Ringkasan RKS', 'Dokumen Kualifikasi'] as $dokumen)
                                @if ($dokumen_checked[$dokumen])
                                    @php
                                        $tanggalPengajuan = optional($pengadaans->{'tanggal_' . strtolower(str_replace(' ', '_', $dokumen))})->tanggal_pengajuan ?? null;
                                        $status = null;

                                        if ($dokumen == 'Rencana Anggaran Biaya' && $statusRab && in_array($statusRab->id_status, [2, 3, 8])) {
                                            $status = $statusRab->keterangan_status;
                                        } elseif ($dokumen == 'Justifikasi Penunjukan Langsung' && $statusJustifikasi && in_array($statusJustifikasi->id_status, [2, 3, 8])) {
                                            $status = $statusJustifikasi->keterangan_status;
                                        } elseif ($dokumen == 'Nota Dinas Permintaan Pengadaan' && $statusNotaDinasPermintaan && in_array($statusNotaDinasPermintaan->id_status, [2, 3, 8])) {
                                            $status = $statusNotaDinasPermintaan->keterangan_status;
                                        } elseif ($dokumen == 'Nota Dinas Permintaan Pelaksanaan Pengadaan' && $statusNotaDinasPelaksanaan && in_array($statusNotaDinasPelaksanaan->id_status, [2,3, 4, 8,11, 12, 13, 14, 15, 16, 17])) {
                                            $status = $statusNotaDinasPelaksanaan->keterangan_status;
                                        } elseif ($dokumen == 'HPE' && $statusHPE && in_array($statusHPE->id_status, [2,3, 4, 11, 12, 13, 14, 15, 16, 17])) {
                                            $status = $statusHPE->keterangan_status;
                                        } elseif ($dokumen == 'RKS' && $statusRKS && in_array($statusRKS->id_status, [2,3, 4, 11, 12, 13, 14, 15, 16, 17])) {
                                            $status = $statusRKS->keterangan_status;
                                        } elseif ($dokumen == 'Ringkasan RKS' && $statusRingkasanRKS && in_array($statusRingkasanRKS->id_status, [2,3, 4, 11, 12, 14, 15, 16, 17])) {
                                            $status = $statusRingkasanRKS->keterangan_status;
                                        } elseif ($dokumen == 'Dokumen Kualifikasi' && $statusDokumenKualifikasi && in_array($statusDokumenKualifikasi->id_status, [2,3, 4, 11, 12, 14, 15, 16, 17])) {
                                            $status = $statusDokumenKualifikasi->keterangan_status;
                                        } 
                                    @endphp

                                    @if ($status)
                                        <tr>
                                            <td>{{ $dokumen }}</td>
                                            <td>
                                                @if ($dokumen == 'Rencana Anggaran Biaya')
                                                    @if ($rab)
                                                        {{ $rab->tanggal_pengajuan }}
                                                    @endif
                                                @elseif ($dokumen == 'Justifikasi Penunjukan Langsung')
                                                    @if ($justifikasi)
                                                        {{ $justifikasi->tanggal_pengajuan }}
                                                    @endif
                                                @elseif ($dokumen == 'Nota Dinas Permintaan Pengadaan')
                                                    @if ($notaDinasPermintaan)
                                                        {{ $notaDinasPermintaan->tanggal_pengajuan }}
                                                    @endif
                                                @elseif ($dokumen == 'Nota Dinas Permintaan Pelaksanaan Pengadaan')
                                                    @if ($notaDinasPelaksanaan)
                                                        {{ $notaDinasPelaksanaan->tanggal_pengajuan_pelaksanaan ?? '' }}
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
                                                    @if ($rks)
                                                        {{ $rks->tanggal_pengajuan }}
                                                    @endif
                                                @elseif ($dokumen == 'Dokumen Kualifikasi')
                                                    @if ($dokumenKualifikasi)
                                                        {{ $dokumenKualifikasi->tanggal_pengajuan }}
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if ($dokumen == 'Rencana Anggaran Biaya')
                                                    @if ($statusRab)
                                                        @if ($statusRab->id_status == 2 || $statusRab->id_status == 15)
                                                            <span class="badge badge-danger">{{ $statusRab->keterangan_status }}</span>
                                                        @elseif ($statusRab->id_status == 3 || $statusRab->id_status == 4 || $statusRab->id_status == 5 || $statusRab->id_status == 12)
                                                            <span class="badge badge-success">{{ $statusRab->keterangan_status }}</span>
                                                        @else
                                                            <span class="badge badge-warning">{{ $statusRab->keterangan_status }}</span>
                                                        @endif
                                                    @else
                                                        Status Tidak Ditemukan
                                                    @endif
                                                @elseif ($dokumen == 'Justifikasi Penunjukan Langsung')
                                                    @if ($statusJustifikasi)
                                                        @if ($statusJustifikasi->id_status == 2 || $statusJustifikasi->id_status == 15)
                                                            <span class="badge badge-danger">{{ $statusJustifikasi->keterangan_status }}</span>
                                                        @elseif ($statusJustifikasi->id_status == 3 || $statusJustifikasi->id_status == 4 || $statusJustifikasi->id_status == 5 || $statusJustifikasi->id_status == 12)
                                                            <span class="badge badge-success">{{ $statusJustifikasi->keterangan_status }}</span>
                                                        @else
                                                            <span class="badge badge-warning">{{ $statusJustifikasi->keterangan_status }}</span>
                                                        @endif
                                                    @else
                                                        Status Tidak Ditemukan
                                                    @endif
                                                @elseif ($dokumen == 'Nota Dinas Permintaan Pengadaan')
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
                                            </td>                                            <td>
                                                @if ($dokumen == 'Rencana Anggaran Biaya')
                                                    @if (in_array($statusRab->id_status, [2, 3, 8]))
                                                        <a href="{{ route('pejabatuser.approve.rab', ['ID_Pengadaan' => $pengadaans->ID_Pengadaan, 'ID_RAB' => $rab->ID_RAB]) }}" class="btn btn-info">Detail</a>
                                                    @endif
                                                @elseif ($dokumen == 'Justifikasi Penunjukan Langsung')
                                                    @if (in_array($statusJustifikasi->id_status, [2, 3, 8]))
                                                        <a href="{{ route('pejabatuser.approve.justifikasi', ['ID_Pengadaan' => $pengadaans->ID_Pengadaan, 'ID_JPL' => $justifikasi->ID_JPL]) }}" class="btn btn-info">Detail</a>
                                                    @endif
                                                @elseif ($dokumen == 'Nota Dinas Permintaan Pengadaan')
                                                    @if (in_array($statusNotaDinasPermintaan->id_status, [2, 3, 8]))
                                                        <a href="{{ route('pejabatuser.approve.nota-dinas-permintaan', ['ID_Pengadaan' => $pengadaans->ID_Pengadaan, 'id_nota_dinas_permintaan' => $notaDinasPermintaan->id_nota_dinas_permintaan]) }}" class="btn btn-info">Detail</a>
                                                    @endif
                                                @elseif ($dokumen == 'Nota Dinas Permintaan Pelaksanaan Pengadaan')
                                                    @if (in_array($statusNotaDinasPelaksanaan->id_status, [2, 3, 4, 8, 11, 12, 13, 14, 15, 16, 17]))
                                                        <a href="{{ route('pejabatuser.approve.nota-dinas-pelaksanaan', ['ID_Pengadaan' => $pengadaans->ID_Pengadaan, 'id_nota_dinas_permintaan' => $notaDinasPelaksanaan->id_nota_dinas_permintaan]) }}" class="btn btn-info">Detail</a>
                                                    @endif
                                                @elseif ($dokumen == 'HPE')
                                                    @if (in_array($statusHPE->id_status, [2,3, 4, 11, 12, 13, 14, 15, 16, 17]))
                                                        {{-- <a href="{{ route('hpe.preview', ['ID_Pengadaan' => $pengadaans->ID_Pengadaan, 'ID_HPE' => $hpe->ID_HPE]) }}" class="btn btn-info">Detail</a> --}}
                                                        <a href="{{ route('pejabatuser.approve.hpe', ['ID_Pengadaan' => $pengadaans->ID_Pengadaan, 'ID_HPE' => $hpe->ID_HPE]) }}" class="btn btn-info">Detail</a>
                                                    @endif
                                                @elseif ($dokumen == 'RKS')
                                                    @if (in_array($statusRKS->id_status, [2,3, 4, 11, 12, 14, 15, 16, 17]))
                                                        <a href="{{ route('rks.preview', ['ID_Pengadaan' => $pengadaans->ID_Pengadaan, 'ID_Ringkasan_Rks' => $rks->ID_Ringkasan_Rks]) }}" class="btn btn-info" target="blank">Detail</a>
                                                    @endif
                                                @elseif ($dokumen == 'Ringkasan RKS')
                                                    @if (in_array($statusRingkasanRKS->id_status, [2,3, 4, 11, 12, 13, 14, 15, 16, 17]))
                                                        <a href="{{ route('pejabatuser.approve.rks', ['ID_Pengadaan' => $pengadaans->ID_Pengadaan, 'ID_Ringkasan_Rks' => $rks->ID_Ringkasan_Rks]) }}" class="btn btn-info">Detail</a>
                                                    @endif
                                                @elseif ($dokumen == 'Dokumen Kualifikasi')
                                                    @if (in_array($statusDokumenKualifikasi->id_status, [2,3, 4, 11, 12, 14, 15, 16, 17]))
                                                        <a href="{{ route('dokumen.preview', ['ID_Pengadaan' => $pengadaans->ID_Pengadaan, 'ID_Dokumen_Kualifikasi' => $dokumenKualifikasi->ID_Dokumen_Kualifikasi]) }}" class="btn btn-info" target="blank">Detail</a>
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
