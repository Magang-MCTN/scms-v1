@extends('dashboard.app')
<style>
    .custom-file {
        position: relative;
        display: inline-block;
    }

    .custom-file-input {
        position: relative;
        z-index: 2;
        width: 100%;
        height: calc(1.6em + 0.75rem + 2px);
        margin: 0;
        opacity: 0;
    }

    .custom-file-label {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        z-index: 1;
        pointer-events: none;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }

    .custom-file-input:focus~.custom-file-label {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
</style>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header"><center>{{ __('HARGA PERHITUNGAN ENGINEERING (HPE)') }}</center></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('hpe.store', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan]) }}" enctype="multipart/form-data">
                        @csrf

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
                            <label for="judul_pengadaan">Nama Pekerjaan :</label>
                            <br>
                            <label><b>{{ $pengadaan->Judul_Pengadaan }}</b></label>
                        </div>

                        <div class="form-group">
                            <label for="hpe">HPE</label>
                            <input type="number" step="any" name="hpe" id="hpe" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="pagu_anggaran">Pagu Anggaran :</label>
                            <br>
                            <label><b>RP.&nbsp;{{ $notaDinasPermintaan->pagu_anggaran }}</b></label>
                        </div>

                        @if ($rencanaMulaiFormatted && $rencanaSelesaiFormatted)
                        <div>
                            <label for="rencana_tanggal_terkontrak_mulai">Rencana Tanggal Terkontrak Mulai</label>
                            <span style="margin: 0 130px;"></span>
                            <label for="rencana_tanggal_terkontrak_selesai">Rencana Tanggal Terkontrak Selesai</label>
                        </div>
                        <div class="form-group" style="display: flex; align-items: center;" >
                                <label style="width: 45%;"><b>{{ $pengadaan->rencana_tanggal_terkontrak_mulai }}</b></label>
                                <span style="margin: 0 18px;"><b></b></span>
                                <label style="width: 45%;"><b>{{ $pengadaan->rencana_tanggal_terkontrak_selesai }}</b></label>
                        </div>
                        @endif

                        @if ($pengadaan->rencana_durasi_kontrak && $pengadaan->rencana_durasi_kontrak_tanggal)
                        <div class="form-group">
                            <label for="rencana_durasi_kontrak">Rencana Durasi Kontrak :</label>
                            <br>
                            <label><b>{{ $pengadaan->rencana_durasi_kontrak }}</b>&nbsp;&nbsp;<label><b>{{ $pengadaan->rencana_durasi_kontrak_tanggal }}</b></label></label>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="jenis_pengadaan" name="jenis_pengadaan" id="jenis_pengadaan">Jenis Pengadaan :</label>
                            <br>
                            <label><b>{{ $jenisPengadaan->Jenis_Pengadaan }}</b></label>
                        </div>

                        @if ($jenisPengadaan->ID_Jenis_Pengadaan != 4)
                        <div class="form-group" for="sumber-referensi-barang" name="sumber-referensi-barang" id="sumber-referensi-barang" >
                            <h3>Sumber Referensi</h3>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_1" id="checklist_1">
                                <label class="form-check-label" for="checklist_1">Informasi Harga Pabrikan/Agen Tunggal</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_2" id="checklist_2">
                                <label class="form-check-label" for="checklist_2">Informasi Harga Pasar</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_3" id="checklist_3">
                                <label class="form-check-label" for="checklist_3">Informasi Harga dari data Badan Pusat Statistik</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_4" id="checklist_4">
                                <label class="form-check-label" for="checklist_4">Hasil Perhitungan Konsultan Enjiniring</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_5" id="checklist_5">
                                <label class="form-check-label" for="checklist_5">Harga Kontrak yang lalu pada Pekerjaan yang sejenis</label>
                            </div>
                        @else
                        <div class="form-group" for="sumber-referensi-jasa" name="sumber-referensi-jasa" id="sumber-referensi-jasa" >
                            <h3>Sumber Referensi</h3>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_6" id="checklist_6">
                                <label class="form-check-label" for="checklist_6">HPE yang dimutakhirkan</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_7" id="checklist_7">
                                <label class="form-check-label" for="checklist_7">Daftar renumerasi konsultan dari asosiasi</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_8" id="checklist_8">
                                <label class="form-check-label" for="checklist_8">Besarnya Gaji yang pernah dibayarkan</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_9" id="checklist_9">
                                <label class="form-check-label" for="checklist_9">Informasi lain terkait biaya konsultan</label>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="pejabatRendan">Dikirim Kepada :</label>
                            <select name="pejabatRendan" id="pejabatRendan" class="form-control" required>
                                <option value=""> </option>
                                @foreach($pejabatRendanOptions as $option)
                                    <option value="{{ $option->name }}" {{ $pejabatRendan && $option->name == $pejabatRendan ? 'selected' : '' }}>
                                        {{ $option->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- <div class="form-group">
                            <label for="attachment_file">+&nbsp; Attachment File</label>
                            <input type="file" name="attachment_file" id="attachment_file" class="form-control-file">
                        </div> --}}

                        <div class="form-group">
                            <label for="attachment_file">+ Attachment File</label>
                            <div class="custom-file">
                                <input type="file" name="attachment_file" id="attachment_file" class="custom-file-input">
                                <label class="custom-file-label" id="fileLabel" for="attachment_file">Choose file</label>
                            </div>
                        </div>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
 
    // Ambil elemen select jenis_pengadaan
    const jenisPengadaanSelect = document.getElementById("jenis_pengadaan");

    // Ambil elemen formulir URL KAK dan URL Spesifikasi Teknis
    const sumberReferensiJasa = document.getElementById("sumber-referensi-jasa");
    const sumberReferensiBarang = document.getElementById("sumber-referensi-barang");

    // Tambahkan event listener untuk perubahan pada jenis_pengadaan
    jenisPengadaanSelect.addEventListener("change", function() {

        sumberReferensiJasa.style.display = "none";
        sumberReferensiBarang.style.display = "none";

        // Tampilkan elemen yang sesuai dengan jenis_pengadaan
        if (jenisPengadaanSelect.value === "Jasa Konsultasi") {
            sumberReferensiJasa.style.display = "block";
        } else if (jenisPengadaanSelect.value === "Jasa Konstruksi" || jenisPengadaanSelect.value === "Barang" || jenisPengadaanSelect.value === "Jasa Lainnya" || jenisPengadaanSelect.value === "Pengadaan Khusus") {
            sumberReferensiBarang.style.display = "block";
        }
    });
});

$(document).ready(function () {
        // When a file is selected, update the label
        $('.custom-file-input').on('change', function () {
            var fileName = $(this).val().split('\\').pop();
            $('#fileLabel').text(fileName);
        });
    });
</script>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

