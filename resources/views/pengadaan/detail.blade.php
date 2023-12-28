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
                            {{-- Tambahkan foreach untuk setiap dokumen --}}
                            @foreach(['Rencana Anggaran Biaya', 'Justifikasi Penunjukan Langsung','Nota Dinas Permintaan Pengadaan','Nota Dinas Permintaan Pelaksanaan Pengadaan'] as $dokumen)
                            {{-- {{ dd($dokumen_checked) }} --}}
                                {{-- Tambahkan kondisi untuk menentukan apakah bagian ini perlu ditampilkan --}}
                                @if ($dokumen_checked[$dokumen])
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
                                                @if ($statusNotaDinasPelaksanaan)
                                                    {{ $notaDinasPelaksanaan->tanggal_pengajuan_pelaksanaan ?? ''}}
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
                                            @endif
                                        </td>
                                        
                                        <td>
                                        @if ($dokumen == 'Rencana Anggaran Biaya')
                                            @if ($pengadaan->id_status_rab == 6 )
                                                <a href="{{ route('rab.index', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan]) }}" class="btn btn-info">Detail</a>
                                                
                                            @elseif ($rab)
                                                <a href="{{ route('rab.preview', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan, 'ID_RAB' => $rab->ID_RAB]) }}" class="btn btn-info">Detail</a>
                                                @else
                                                Tidak ada
                                            @endif
                                        @elseif ($dokumen == 'Justifikasi Penunjukan Langsung')
                                            @if ($pengadaan->id_status_justifikasi == 6 )
                                            <a href="{{ route('justifikasi.index', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan]) }}" class="btn btn-info">Detail</a>
                                            @elseif ($justifikasi)
                                            <a href="{{ route('justifikasi.preview', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan, 'ID_JPL' => $justifikasi->ID_JPL]) }}" class="btn btn-info">Detail</a>
                                            @else
                                                Tidak ada
                                            @endif
                                        @elseif ($dokumen == 'Nota Dinas Permintaan Pengadaan')
                                            @if (in_array($pengadaan->id_status_rab, [3]))
                                                @if ($pengadaan->id_status_nota_dinas_permintaan == 6)
                                                    <a href="{{ route('nota_dinas_permintaan.index', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan]) }}" class="btn btn-info">Detail</a>
                                                @else
                                                    <a href="{{ route('nota_dinas_permintaan.preview', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan, 'id_nota_dinas_permintaan' => $notaDinasPermintaan->id_nota_dinas_permintaan]) }}" class="btn btn-info">Detail</a>
                                                @endif
                                            @else
                                                Surat RAB perlu Dibuat dan Disetujui
                                            @endif
                                        @elseif ($dokumen == 'Nota Dinas Permintaan Pelaksanaan Pengadaan')
                                            @if (in_array($pengadaan->id_status_ringkasan_rks, [3]) || in_array($pengadaan->id_status_hpe, [3]))
                                                @if ($pengadaan->id_status_nota_dinas_pelaksanaan == 6)
                                                    <a href="{{ route('nota_dinas_pelaksanaan.index', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan, 'id_nota_dinas_permintaan' => $notaDinasPelaksanaan->id_nota_dinas_permintaan]) }}" class="btn btn-info">Detail</a>
                                                @else
                                                    <a href="{{ route('nota_dinas_pelaksanaan.preview', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan, 'id_nota_dinas_permintaan' => $notaDinasPelaksanaan->id_nota_dinas_permintaan]) }}" class="btn btn-info">Detail</a>
                                                @endif
                                            @else
                                            Perlu Persetujuan Semua Dokumen dari Pejabat Rendan
                                            @endif
                                        @endif
                                        </td>
                                    </tr>
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
