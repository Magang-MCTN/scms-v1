@extends('dashboard.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header">{{ __('Form Pengajuan Barang') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('pengadaan_scm.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nomor_pengadaan">Nomor Pengadaan: A123</label>
                            <input type="text" name="nomor_pengadaan" id="nomor_pengadaan" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="judul_pengadaan">Judul Pengadaan</label>
                            <select name="judul_pengadaan" id="judul_pengadaan" class="form-control" disabled>
                                <option value=""> </option>
                                <option value="Permintaan dokumen rencana pengadaan">Permintaan Dokumen Rencana Pengadaan</option>
                                <option value="Permintaan pelaksanaan pengadaan">Permintaan Pelaksanaan Pengadaan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tujuan">Tujuan:</label>
                            <select id="tujuan" name="tujuan">
                                {{-- @foreach($adminTimList as $adminTimId => $adminTimjabatan) --}}
                                <option value=""></option>
                                <option value="Rendan">Rendan</option>
                                <option value="Lakdan">Lakdan</option>
                                    {{-- <option value="{{ $adminTimId }}">{{ $adminTimjabatan }}</option> --}}
                                {{-- @endforeach --}}
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="perihal">Perihal</label>
                            <select name="perihal" id="perihal" class="form-control" disabled>
                                <option value=""> </option>
                                <option value="Permintaan dokumen rencana pengadaan">Permintaan Dokumen Rencana Pengadaan</option>
                                <option value="Permintaan pelaksanaan pengadaan">Permintaan Pelaksanaan Pengadaan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nama_pekerjaan">Nama Pekerjaan</label>
                            <input type="text" name="nama_pekerjaan" id="nama_pekerjaan" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="ringkasan_pekerjaan">Ringkasan Pekerjaan</label>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="ringkasan_pekerjaan"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_pengguna">Nama Pengguna</label>
                            <input type="text" name="nama_pengguna" id="nama_pengguna" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="divisi_pengguna">Divisi Pengguna</label>
                            <input type="text" name="divisi_pengguna" id="divisi_pengguna" class="form-control" required>
                        </div>


                        <div class="form-group">
                            <label for="jenis_pengadaan">Jenis Pengadaan</label>
                            <select name="jenis_pengadaan" id="jenis_pengadaan" class="form-control" required>
                                <option value=""> </option>
                                <option value="Barang">Barang</option>
                                <option value="Jasa Kontruksi">Jasa Kontruksi</option>
                                <option value="Jasa Konsultasi">Jasa Konsultasi</option>
                                <option value="Jasa Lainnya">Jasa Lainnya</option>
                                <option value="Pengadaan Khusus">Pengadaan Khusus</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="informasi_anggaran">Informasi Anggaran / No. PRK</label>
                            <input type="number" step="any" name="informasi_anggaran" id="informasi_anggaran" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="sumber_anggaran">Sumber Anggaran</label>
                            <select name="sumber_anggaran" id="sumber_anggaran" class="form-control" required>
                                <option value=""> </option>
                                <option value="Anggaran Investasi">Anggaran Investasi</option>
                                <option value="Anggaran Operasi">Anggaran Operasi</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pagu_anggaran">Pagu Anggaran</label>
                            <input type="number" step="any" name="pagu_anggaran" id="pagu_anggaran" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="cost_center">Cost Center</label>
                            <input type="number" step="any" name="cost_center" id="cost_center" class="form-control" required>
                        </div>

                        <div>
                            <label for="rencana_tanggal_terkontrak_mulai">Rencana Tanggal Terkontrak Mulai</label>
                            <span style="margin: 0 130px;"></span>
                            <label for="rencana_tanggal_terkontrak_selesai">Rencana Tanggal Terkontrak Selesai</label>
                        </div>
                        <div class="form-group" style="display: flex; ">
                                <input type="date" name="rencana_tanggal_terkontrak_mulai" id="rencana_tanggal_terkontrak_mulai" class="form-control" required style="width: 45%;">
                                <span style="margin: 0 15px;"><b>-</b></span>
                                <input type="date" name="rencana_tanggal_terkontrak_selesai" id="rencana_tanggal_terkontrak_selesai" class="form-control" required style="width: 45%;">
                        </div>

                        <div class="form-group">
                            <label for="rencana_durasi_kontrak">Rencana Durasi Kontrak</label>
                            <div class="input-group">
                                <input type="number" name="rencana_durasi_kontrak" id="rencana_durasi_kontrak" class="form-control" required style="width: 70%;">
                                <select name="rencana_durasi_kontrak_tanggal" id="rencana_durasi_kontrak_tanggal" class="form-control" required>
                                    <option value=""> </option>
                                    <option value="Hari Kerja">Hari Kerja</option>
                                    <option value="Hari Kalender">Hari Kalender</option>
                                    <option value="Bulan">Bulan</option>
                                    <option value="Tahun">Tahun</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="label_url_kak" style="display: none;">
                            <label for="url_kak">URL KAK</label>
                            <input type="text" name="url_kak" id="url_kak" class="form-control">
                        </div>

                        <div class="form-group" id="label_url_spesifikasi_teknis" style="display: none;">
                            <label for="url_spesifikasi_teknis">URL Spesifikasi Teknis</label>
                            <input type="text" name="url_spesifikasi_teknis" id="url_spesifikasi_teknis" class="form-control">
                        </div>

                        @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

                    </body>

                    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.ckeditor').ckeditor();
                        });
                    </script> <script>
CKEDITOR.on("instanceReady", function(event) {
	event.editor.on("beforeCommandExec", function(event) {
		// Show the paste dialog for the paste buttons and right-click paste
		if (event.data.name == "paste") {
			event.editor._.forcePasteDialog = true;
		}
		// Don't show the paste dialog for Ctrl+Shift+V
		if (event.data.name == "pastetext" && event.data.commandData.from == "keystrokeHandler") {
			event.cancel();
		}
	})
});</script>

{{-- Muncul Hilang Barang dan Jasa ketika diklik --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil elemen select jenis_pengadaan
        const jenisPengadaanSelect = document.getElementById("jenis_pengadaan");

        // Ambil elemen formulir URL KAK dan URL Spesifikasi Teknis
        const labelUrlKak = document.getElementById("label_url_kak");
        const labelUrlSpesifikasiTeknis = document.getElementById("label_url_spesifikasi_teknis");
        const UrlKak = document.getElementById("url_kak");
        const UrlSpesifikasiTeknis = document.getElementById("url_spesifikasi_teknis");

        // Tambahkan event listener untuk perubahan pada jenis_pengadaan
        jenisPengadaanSelect.addEventListener("change", function() {
            if (jenisPengadaanSelect.value === "Barang") {
                labelUrlKak.style.display = "none";
                labelUrlSpesifikasiTeknis.style.display = "block";
                UrlKak.style.display = "none";
                UrlSpesifikasiTeknis.style.display = "block";
            } else if (jenisPengadaanSelect.value === "Jasa Kontruksi") {
                labelUrlKak.style.display = "block";
                labelUrlSpesifikasiTeknis.style.display = "none";
                UrlKak.style.display = "block";
                UrlSpesifikasiTeknis.style.display = "none";
            } else if (jenisPengadaanSelect.value === "Jasa Konsultasi") {
                labelUrlKak.style.display = "block";
                labelUrlSpesifikasiTeknis.style.display = "none";
                UrlKak.style.display = "block";
                UrlSpesifikasiTeknis.style.display = "none";
            } else if (jenisPengadaanSelect.value === "Jasa Lainnya") {
                labelUrlKak.style.display = "block";
                labelUrlSpesifikasiTeknis.style.display = "none";
                UrlKak.style.display = "block";
                UrlSpesifikasiTeknis.style.display = "none";
            } else {
                labelUrlKak.style.display = "none";
                labelUrlSpesifikasiTeknis.style.display = "none";
                UrlKak.style.display = "none";
                UrlSpesifikasiTeknis.style.display = "none";
            }
        });
    });
</script>

<script>
    document.getElementById("tujuan").addEventListener("change", function () {
        var selectedValue = this.value;
        var judulPengadaan = document.getElementById("judul_pengadaan");
        var perihal = document.getElementById("perihal");

        if (selectedValue === "Rendan") {
            judulPengadaan.value = "Permintaan dokumen rencana pengadaan";
            perihal.value = "Permintaan dokumen rencana pengadaan";
        } else if (selectedValue === "Lakdan") {
            judulPengadaan.value = "Permintaan pelaksanaan pengadaan";
            perihal.value = "Permintaan pelaksanaan pengadaan";
        } else {
            judulPengadaan.value = "";
            perihal.value = "";
        }
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

