@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Unggah Tanda Tangan') }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('signature.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="signature">Pilih atau Gambar Tanda Tangan Anda:</label>
                            <input type="file" name="signature" id="signature" class="form-control-file @error('signature') is-invalid @enderror" required>
                            @error('signature')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Unggah Tanda Tangan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
