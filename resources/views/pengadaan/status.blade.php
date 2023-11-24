<!-- resources/views/status/index.blade.php -->

@extends('dashboard.app')

@section('content')
    <div class="container">
        <h2>Halaman Status</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kuartal</th>
                    <th>Tahun</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    // Filter hanya data yang memiliki id_status_keluar
                    $filteredStatuses = $statuses->filter(function ($status) {
                        return !is_null($status->id_status_keluar);
                    });
                @endphp
                @foreach ($filteredStatuses as $index => $status)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $status->kuartal }}</td>
                        <td>{{ $status->tahun }}</td>
                        <td>{{ $status->statuskeluar->nama ?? '-' }}</td>
                        <td>
                            <a href="{{ route('timk3.detailPeriodelkeluar', $status->id_periode_laporan) }}"
                                class="btn btn-primary">Detail</a>
                            <!-- Tambahkan tombol hapus jika dibutuhkan -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
