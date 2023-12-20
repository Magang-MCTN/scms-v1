@extends('dashboard.app')

@section('content')
    <div class="container">
        <br>
        <br>
        <h4><center>Daftar Vendor Menunggu Persetujuan</center></h4>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Perusahaan</th>
                        <th>Email Perusahaan</th>
                        <th>Alamat Perusahaan</th>
                        <th>No. Telepon Perusahaan</th>
                        <th><center>Action</center></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendors as $vendor)
                    @if ($vendor->approved == 1)
                        <tr>
                            <td>{{ $vendor->nama_perusahaan }}</td>
                            <td>{{ $vendor->email_perusahaan }}</td>
                            <td>{{ $vendor->alamat_perusahaan }}</td>
                            <td>{{ $vendor->no_telepon_perusahaan }}</td>
                            <td> 
                                <form action="{{ route('vendor-page.approved-tolak', ['ID_Vendor' => $vendor->ID_Vendor]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning" onclick="return confirm('Apakah Anda yakin ingin menolak vendor ini?')">Tolak</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('vendor-page.approved-hapus', ['ID_Vendor' => $vendor->ID_Vendor]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus vendor ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        {{-- @else
            <p>Tidak ada vendor yang menunggu persetujuan.</p>
        @endif --}}
    </div>
@endsection