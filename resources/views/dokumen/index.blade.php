@extends('dashboard.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header"><center>{{ __('DOKUMEN KUALIFIKASI') }}</center></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('dokumen.store', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan]) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group" id="dokumen_kualifikasi">
                            <label for="dokumen_kualifikasi">Dokumen Kualifikasi</label>
                            <input type="text" name="dokumen_kualifikasi" id="dokumen_kualifikasi" class="form-control" value="{{ old('dokumen_kualifikasi') }}" placeholder="Contoh: https://mctn.co.id" pattern="https?://.+">
                            @error('dokumen_kualifikasi')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

