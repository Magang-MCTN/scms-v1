@extends('dashboard.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-2">
            <div class="card-header">{{ __('Daftar Pengajuan Pengadaan Barang/Jasa') }}</div>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Pekerjaan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengadaan as $pekerjaan)
                                <tr>
                                    @if (in_array($pekerjaan->id_status, [9, 11, 12, 13 , 14, 15, 16, 17]))
                                    <td>{{ $pekerjaan->Judul_Pengadaan }}</td>
                                    <td class="badge badge-warning">
                                        @php
                                        $statusItem = $pekerjaan->status ?? null;
                                        @endphp
                                        @if ($statusItem)
                                            {{ $statusItem->keterangan_status }}
                                        @else
                                            Status Tidak Ditemukan
                                        @endif
                                    </td>
                                    <td>
                                    @if ($pekerjaan->id_status == 9)
                                        <a href="{{ route('pejabatrendan.detail', ['ID_Pengadaan' => $pekerjaan->ID_Pengadaan]) }}" class="btn btn-info">Lihat Detail</a>
                                    @elseif (in_array($pekerjaan->id_status, [11, 12, 13 , 14, 15, 16, 17]))
                                        <a href="{{ route('pejabatrendan.pekerjaan.detail', ['ID_Pengadaan' => $pekerjaan->ID_Pengadaan]) }}" class="btn btn-info">Lihat Detail</a>
                                    @endif
                                    </td>
                                @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection