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
                            {{-- Tambahkan foreach untuk setiap dokumen --}}
                            @foreach(['Nota Dinas Permintaan Pengadaan', 'HPE', 'RKS', 'Ringkasan RKS', 'Dokumen Kualifikasi'] as $dokumen)
                            {{-- {{ dd($dokumen_checked) }} --}}
                                {{-- Tambahkan kondisi untuk menentukan apakah bagian ini perlu ditampilkan --}}
                                @if ($dokumen_checked[$dokumen])
                                    <tr>
                                        <td>{{ $dokumen }}</td>
                                        <td>
                                            @if ($dokumen == 'Nota Dinas Permintaan Pengadaan')
                                                @if ($notaDinasPermintaan)
                                                    {{ $notaDinasPermintaan->created_at }}
                                                {{-- @else
                                                    Status Tidak Ditemukan --}}
                                                @endif
                                            @elseif ($dokumen == 'HPE')
                                                @if ($hpe)
                                                    {{ $hpe->created_at }}
                                                {{-- @else
                                                    Status Tidak Ditemukan --}}
                                                @endif
                                            @elseif ($dokumen == 'RKS')
                                                @if ($notaDinasPermintaan)
                                                    {{ $notaDinasPermintaan->keterangan_status }}
                                                {{-- @else
                                                    Status Tidak Ditemukan --}}
                                                @endif
                                            @elseif ($dokumen == 'Ringkasan RKS')
                                                @if ($notaDinasPermintaan)
                                                    {{ $notaDinasPermintaan->keterangan_status }}
                                                {{-- @else
                                                    Status Tidak Ditemukan --}}
                                                @endif
                                            @elseif ($dokumen == 'Dokumen Kualifikasi')
                                                @if ($notaDinasPermintaan)
                                                    {{ $notaDinasPermintaan->keterangan_status }}
                                                {{-- @else
                                                    Status Tidak Ditemukan --}}
                                                @endif
                                            @endif
                                        </td>
                                        <td class="badge badge-pill badge-dark">
                                            @if ($dokumen == 'Nota Dinas Permintaan Pengadaan')
                                                @if ($statusNotaDinasPermintaan)
                                                    {{ $statusNotaDinasPermintaan->keterangan_status }}
                                                {{-- @else
                                                    Status Tidak Ditemukan --}}
                                                @endif
                                            @elseif ($dokumen == 'HPE')
                                                @if ($statusHPE)
                                                    {{ $statusHPE->keterangan_status }}
                                                {{-- @else
                                                    Status Tidak Ditemukan --}}
                                                @endif
                                            @elseif ($dokumen == 'RKS')
                                                @if ($statusRKS)
                                                    {{ $statusRKS->keterangan_status }}
                                                {{-- @else
                                                    Status Tidak Ditemukan --}}
                                                @endif
                                            @elseif ($dokumen == 'Ringkasan RKS')
                                                @if ($statusRingkasanRKS)
                                                    {{ $statusRingkasanRKS->keterangan_status }}
                                                {{-- @else
                                                    Status Tidak Ditemukan --}}
                                                @endif
                                            @elseif ($dokumen == 'Dokumen Kualifikasi')
                                                @if ($statusDokumenKualifikasi)
                                                    {{ $statusDokumenKualifikasi->keterangan_status }}
                                                {{-- @else
                                                    Status Tidak Ditemukan --}}
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                        @if ($dokumen == 'Nota Dinas Permintaan Pengadaan')
                                            {{-- @if ($pengadaan->id_status == 9) --}}
                                            @if (in_array($pengadaan->id_status, [11, 12, 13 , 14, 15, 16, 17]))
                                            <a href="{{ route('adminrendan.notadinas.detail', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan]) }}" class="btn btn-info">Lihat Detail</a>
                                            @endif
                                        @elseif ($dokumen == 'HPE')
                                            @if ($pengadaan->id_status_hpe == 6 )
                                            <a href="{{ route('hpe.index', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan]) }}" class="btn btn-info">Detail</a>
                                            @else
                                            <a href="{{ route('hpe.preview', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan, 'ID_HPE' => $hpe->ID_HPE]) }}" class="btn btn-info">Detail</a>
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
