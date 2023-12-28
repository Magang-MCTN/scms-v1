@extends('dashboard.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-2">
            <div class="card-header">{{ __('Daftar Pengajuan Pengadaan Barang/Jasa') }}</div>
            <div class="card">
                <div class="table-responsive home-tab">
                    <table class="table text-center">
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
                                    @if ($pekerjaan->id_admin_rendan == auth()->user()->id_user)
                                    {{-- @if (in_array($statusRab->id_status, [2, 3, 8])) --}}
                                    <td>{{ $pekerjaan->Judul_Pengadaan }}</td>
                                    <td>
                                        @php
                                        $statusItem = $pekerjaan->status ?? null;
                                        @endphp
                                        @if ($statusItem)
                                            @if ($statusItem->id_status == 2 || $statusItem->id_status == 15)
                                                <span class="badge badge-danger">{{ $statusItem->keterangan_status }}</span>
                                                @elseif ($statusItem->id_status == 3|| $statusItem->id_status == 4 || $statusItem->id_status == 5 || $statusItem->id_status == 12)
                                                <span class="badge badge-success">{{ $statusItem->keterangan_status }}</span>
                                                @else
                                                <span class="badge badge-warning">{{ $statusItem->keterangan_status }}</span>
                                                @endif 
                                        @else
                                            Status Tidak Ditemukan
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('adminrendan.detail', ['ID_Pengadaan' => $pekerjaan->ID_Pengadaan]) }}" class="btn btn-primary" style="color:white;">Lihat Detail</a>
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
