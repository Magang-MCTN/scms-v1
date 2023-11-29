@extends('dashboard.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header">
                    <center>{{ __('Edit Perwakilan') }}</center>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('vendor-page-peserta.update', $perwakilan->ID_Peserta) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="Nama_Peserta">Nama Perwakilan</label>
                            <input type="text" class="form-control" id="Nama_Peserta" name="Nama_Peserta" placeholder="Nama Perwakilan" value="{{ $perwakilan->Nama_Peserta }}" required>
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" value="{{ $perwakilan->jabatan }}" required>
                        </div>
                        <div class="form-group">
                            <label for="Email_Peserta">Email Perwakilan</label>
                            <input type="text" class="form-control" id="Email_Peserta" name="Email_Peserta" placeholder="Email Perwakilan" value="{{ $perwakilan->Email_Peserta }}" required>
                        </div>
                        <div class="form-group">
                            <label for="Nomor_Kontak_Peserta">Kontak Perwakilan</label>
                            <input type="text" class="form-control" id="Nomor_Kontak_Peserta" name="Nomor_Kontak_Peserta" placeholder="Kontak Perwakilan" value="{{ $perwakilan->Nomor_Kontak_Peserta }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
