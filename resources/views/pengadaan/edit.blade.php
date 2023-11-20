@extends('dashboard.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header">
                    <center>{{ __('Edit Pengadaan') }}</center>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('pengadaan.update', $pengadaan->ID_Pengadaan) }}">
                        @csrf
                        @method('PUT')

                        <!-- Tambahkan input dan elemen lain sesuai kebutuhan -->
                        <div class="form-group">
                            <label for="Judul_Pengadaan">Nama Pekerjaan</label>
                            <input type="text" id="Judul_Pengadaan" name="Judul_Pengadaan" class="form-control" value="{{ $pengadaan->Judul_Pengadaan }}" required>
                        </div>

                        <!-- Checklist Nota Dinas -->
                        <div class="form-group">
                            <label for="checklist-nota-dinas">Nota Dinas</label>
                            <input type="checkbox" name="checklist_nota_dinas" id="checklist-nota-dinas" {{ $pengadaan->checklist_nota_dinas ? 'checked' : '' }}>
                        </div>

                        <!-- Checklist Rencana Anggaran Biaya -->
                        <div class="form-group">
                            <label for="checklist-rab">Rencana Anggaran Biaya</label>
                            <input type="checkbox" name="checklist_rab" id="checklist-rab" {{ $pengadaan->checklist_rab ? 'checked' : '' }}>
                        </div>

                        <!-- Checklist Justifikasi Penunjukan Langsung -->
                        <div class="form-group">
                            <label for="checklist-justifikasi">Justifikasi Penunjukan Langsung</label>
                            <input type="checkbox" name="checklist_justifikasi" id="checklist-justifikasi" {{ $pengadaan->checklist_justifikasi ? 'checked' : '' }}>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
