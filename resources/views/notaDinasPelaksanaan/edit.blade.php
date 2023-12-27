@extends('dashboard.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header"><center><b>{{ __('Nota Dinas -  Permintaan Pelaksanaan Pengadaan Barang/Jasa') }}</b><center></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('nota_dinas_pelaksanaan.update', ['ID_Pengadaan'=>$pengadaan->ID_Pengadaan, 'id_nota_dinas_permintaan' => $notaDinasPelaksanaan->id_nota_dinas_permintaan]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="Nomor_ND_Lakdan">Nomor ND Lakdan</label>
                            <input type="text" name="Nomor_ND_Lakdan" id="Nomor_ND_Lakdan" class="form-control" required value="{{ old('Nomor_ND_Lakdan', $notaDinasPelaksanaan->Nomor_ND_Lakdan) }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

