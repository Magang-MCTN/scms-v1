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
                                            <td>
                                                @if ($dokumen == 'Rencana Anggaran Biaya')
                                                    @if ($rab)
                                                        {{ $rab->created_at }}
                                                    @else
                                                        Status Tidak Ditemukan
                                                    @endif
                                                @elseif ($dokumen == 'Justifikasi Penunjukan Langsung')
                                                    @if ($justifikasi)
                                                        {{ $justifikasi->created_at }}
                                                    @else
                                                        Status Tidak Ditemukan
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="badge badge-pill badge-dark">{{ $status }}</td>
                                            <td>
                                                @if ($dokumen == 'Rencana Anggaran Biaya')
                                                    {{-- @if ($pengadaans->id_status_rab == 8 ) --}}
                                                    @if (in_array($statusRab->id_status, [8, 9, 10]))
                                                        <a href="{{ route('pejabatuser.approve.rab', ['ID_Pengadaan' => $pengadaans->ID_Pengadaan, 'ID_RAB' => $rab->ID_RAB]) }}" class="btn btn-info">Detail</a>
                                                    @else
                                                        Anda Sudah Menyetujuinya
                                                    @endif
                                                @elseif ($dokumen == 'Justifikasi Penunjukan Langsung')
                                                    {{-- @if ($pengadaans->id_status_rab == 8 ) --}}
                                                    @if (in_array($statusJustifikasi->id_status, [8, 9, 10]))
                                                        <a href="{{ route('pejabatuser.approve.justifikasi', ['ID_Pengadaan' => $pengadaans->ID_Pengadaan, 'ID_JPL' => $justifikasi->ID_JPL]) }}" class="btn btn-info">Detail</a>
                                                    @else
                                                        Anda Sudah Menyetujuinya
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
