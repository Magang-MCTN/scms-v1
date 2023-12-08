@extends('dashboard.app')

@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Rencana Anggaran Biaya</h4>
        </div>
        <form method="POST" action="{{ route('rab.rangkum', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan]) }}" id="rab-form">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="kota">Kota:</label>
                    <select name="kota" id="kota" class="form-control" required>
                        <option value=""> </option>
                        @foreach($kotaOptions as $option)
                            <option value="{{ $option->Kota }}" {{ $kota && $option->Kota == $kota->id ? 'selected' : '' }}>
                                {{ $option->Kota }}
                            </option>
                        @endforeach
                    </select>
                </div>

                    <div class="form-group">
                        <label for="Tanggal">Tanggal</label>
                        <input type="date" name="Tanggal" id="Tanggal" class="form-control" required>
                    </div>

                <div class="form-group">
                    <label for="total_keseluruhan">Total Keseluruhan (Rp):</label>
                    <input type="number" name="total_keseluruhan" id="total_keseluruhan" class="form-control" readonly>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection

