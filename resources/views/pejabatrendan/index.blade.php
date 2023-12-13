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
                                    @if ($pekerjaan->id_status_nota_dinas_permintaan == 9)
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
                                        <a href="{{ route('pejabatrendan.detail', ['ID_Pengadaan' => $pekerjaan->ID_Pengadaan]) }}" class="btn btn-info">Lihat Detail</a>
                                    </td>
                                    @else
                                    <a style="display: none;"></a>
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
