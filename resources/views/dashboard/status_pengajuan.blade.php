<!-- resources/views/status_pengadaan.blade.php -->
@extends('dashboard.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3>Riwayat Pengadaan Barang</h3>
                        <div class="d-flex ">
                            <form method="GET" action="{{ route('status') }}" class="me-4">
                                <label class="mb-2">Cari Nama Barang</label>
                                <div class="d-flex align-self-center">
                                    <input type="text" id="search" class="form-control me-1" name="search" value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                                </div>
                            </form>

                            <form method="GET" action="{{ route('pengadaan.index') }}">
                                <label for="floatingSelectDisabled" class="mb-2">Filter berdasarkan Status:</label>
                                <div class="">
                                    <select name="status" onchange="this.form.submit()" class="form-select" id="floatingSelectDisabled" aria-label="Floating label disabled select example">
                                        <option class="form-control"value="semua" class="preview-subject ellipsis font-weight-medium text-dark" {{ $selectedStatus === 'semua' ? 'selected' : '' }}>Semua</option>
                                        <option class="form-control"value="diajukan" {{ $selectedStatus === 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                                        <option class="form-control"value="disetujui_admin_general" {{ $selectedStatus === 'disetujui_admin_general' ? 'selected' : '' }}>Disetujui</option>
                                        <option class="form-control"value="ditolak" {{ $selectedStatus === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- </form> --}}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Nomor Pengadaan</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Status</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengadaanBarang as $item)
                                <tr>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->nomor_pengadaan }}</td>
                                    <td>{{ $item->tanggal_pengajuan }}</td>
                                    <td>
                                        @if($item->status === 'disetujui_admin_tim')
                                            <span class="badge badge-opacity-warning ">Disetujui Admin Tim </span>

                                        @elseif($item->status === 'disetujui_admin_manager')
                                            <span class="badge badge-opacity-success">Disetujui  </span>
                                        @elseif($item->status === 'diajukan')
                                            <span class="badge badge-opacity-warning">Menunggu Persetujuan </span>
                                            @elseif($item->status === 'disetujui_admin_general')
                                            <span class="badge badge-opacity-warning">Telah Disetujui Admin General</span>
                                        @else
                                            <span class="badge badge-opacity-danger">Di Tolak</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('detail', $item->id) }}" class="btn btn-info">Lihat</a>
                                    </td>
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
