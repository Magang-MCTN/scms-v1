@extends('dashboard.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header"><center>{{ __('JUSTIFIKASI PENUNJUKAN LANGSUNG') }}</center></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('justifikasi.update', ['ID_Pengadaan' => $justifikasiID->ID_Pengadaan,'ID_JPL' =>$justifikasiID->ID_JPL]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="kota">Kota:</label>
                            <select name="kota" id="kota" class="form-control" required>
                                <option value=""> </option>
                                @foreach($kotaOptions as $option)
                                    <option value="{{ $option->Kota }}" {{ old('kota', $justifikasiID->ID_Kota) == $option->ID_Kota ? 'selected' : '' }}>
                                        {{ $option->Kota }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
            
                            <div class="form-group">
                                <label for="Tanggal">Tanggal</label>
                                <input type="date" name="Tanggal" id="Tanggal" class="form-control" required value="{{ old('Tanggal', $justifikasiID->Tanggal) }}">
                            </div>

                        <div class="d-flex justify-content-between">
                            <h3>Nama Pekerjaan: {{ $justifikasiID->Judul_Pengadaan }}</h3>
                        </div>

                        <div class="form-group">
                            <label for="jenis_pengadaan">Jenis Pengadaan</label>
                            <select name="jenis_pengadaan" id="jenis_pengadaan" class="form-control" required>
                                <option value=""> </option>
                                @foreach($jenisPengadaanOptions as $option)
                                <option value="{{ $option->Jenis_Pengadaan }}" {{ old('jenis_pengadaan', $jenisPengadaan) == $option->ID_Jenis_Pengadaan ? 'selected' : '' }}>
                                    {{ $option->Jenis_Pengadaan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nama_perusahaan">Peserta Penunjukan Langsung</label>
                            <select name="nama_perusahaan" id="nama_perusahaan" class="form-control" required>
                                <option value=""> </option>
                                @foreach($namaPesertaOptions as $option)
                                <option value="{{ $option->nama_perusahaan }}" {{ old('nama_perusahaan', $justifikasiID->nama_perusahaan) == $option->nama_perusahaan ? 'selected' : '' }}>
                                        {{ $option->nama_perusahaan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pagu_anggaran">Pagu Anggaran</label>
                            <input type="number" step="any" name="pagu_anggaran" id="pagu_anggaran" class="form-control" required value="{{ old('pagu_anggaran', $justifikasiID->pagu_anggaran) }}">
                        </div>

                        <div class="form-group">
                            <h3 for="ringkasan_pekerjaan">Ringkasan Kondisi</h3>
                            <label>Bagaimana status kondisi saat ini dan aktivitas apa yang mengakibatkan dibutuhkannya Penunjukan Langsung ini?</label>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="Rincian_Status_Kondisi">{{ old('Rincian_Status_Kondisi', $justifikasiID->Rincian_Status_Kondisi) }}</textarea>
                            </div>

                            <label>Mengapa metode Penunjukan Langsung yang dipilih?</label>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="Rincian_Alasan_Metode">{{ old('Rincian_Alasan_Metode', $justifikasiID->Rincian_Alasan_Metode) }}</textarea>
                            </div>

                            <label>Apa kriteria yang digunakan untuk memilih Peserta Tender terpilih?(Teknis)</label>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="Rincian_Kriteria_Peserta_Teknis">{{ old('Rincian_Kriteria_Peserta_Teknis', $justifikasiID->Rincian_Kriteria_Peserta_Teknis) }}</textarea>
                            </div>

                            <label>Apa kriteria yang digunakan untuk memilih Peserta Tender terpilih?(Komersial)</label>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="Rincian_Kriteria_Peserta_Komersial">{{ old('Rincian_Kriteria_Peserta_Komersial', $justifikasiID->Rincian_Kriteria_Peserta_Komersial) }}</textarea>
                            </div>

                            <label>Apa kriteria yang digunakan untuk memilih Peserta Tender terpilih?(Lainnya)</label>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="Rincian_Kriteria_Peserta_Lainnya">{{ old('Rincian_Kriteria_Peserta_Lainnya', $justifikasiID->Rincian_Kriteria_Peserta_Lainnya) }}</textarea>
                            </div>
                        </div>

                        @if ($pengadaan->ID_Jenis_Pengadaan != 4)
                        <div class="form-group" for="kriteria-barang" name="kriteria-barang" id="kriteria-barang" >
                            <h3>Kriteria</h3>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_1" id="checklist_1" {{ $kriteria->checklist_1 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_1">Pengadaan barang, pekerjaan konstruksi, jasa lainnya yang bersifat spesifik,
                                    1. Barang yang dibutuhkan, hanya diproduksi oleh satu pabrik tertentu
                                    2. Satu-satunya pabrik pemiliki jaminan (warranty) dari Original Equipment Manufacture (OEM)
                                    3. Pekerjaan yang akan dilaksanakan hanya dapat dilakukan oleh pemegang hak intelektual (HAKI)</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_2" id="checklist_2" {{ $kriteria->checklist_2 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_2">Hanya terdapat satu penyedia barang/jasa yang dapat melaksanakan pekerjaan sesuai dengan kebutuhan Pengguna Barang/Jasa</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_3" id="checklist_3" {{ $kriteria->checklist_3 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_3">Penyedia Barang/Jasa adalah lembaga negara, pejabat negara, perguruan tinggi dan afiliasinya.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_4" id="checklist_4" {{ $kriteria->checklist_4 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_4">Pengadaan Barang/Jasa yang ditender ulang mengalami kegagalan.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_5" id="checklist_5" {{ $kriteria->checklist_5 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_5">Pekerjaan penugasan dari Direksi atas penugasan pemerintah dalam rangka pembangunan infrastruktur ketenagalistrikan.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_6" id="checklist_6" {{ $kriteria->checklist_6 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_6">Untuk melaksanakan proyek pengembangan teknologi.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_7" id="checklist_7" {{ $kriteria->checklist_7 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_7">Dalam rangka National Capacity Building (NCB).</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_8" id="checklist_8" {{ $kriteria->checklist_8 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_8">Pemeliharaan unit pembangkit dalam bentuk kesepakatan jangka panjang/Long Term Service/Supply Agreement (LTSA).</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_9" id="checklist_9" {{ $kriteria->checklist_9 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_9">Pekerjaan akibat bencana alam baik lokal maupun nasional (force majeure).</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_10" id="checklist_10" {{ $kriteria->checklist_10 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_10">Pekerjaan darurat (emergency) untuk keamanan dan keselamatan masyarakat dan aset strategis perusahaan.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_11" id="checklist_11" {{ $kriteria->checklist_11 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_11">Pemberian bantuan bencana alam dan/atau untuk Corporate Social Responsibility (CSR).</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_12" id="checklist_12" {{ $kriteria->checklist_12 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_12">Penyedia Barang/Jasa adalah BUMN, Anak Perusahaan PLN/Anak Perusahaan BUMN atau Perusahaan Terafiliasi PLN/Perusahaan Terafiliasi BUMN, sepanjang barang dan/atau jasa dimaksud adalah merupakan produk atau layanan BUMN, Anak Perusahaan PLN/Anak Perusahaan BUMN, Perusahaan Terafiliasi PLN/Perusahaan Teafiliasi BUMN, dan/atau usaha kecil dan mikro, sepanjang kualitas, harga, dan tujuannya dapat dipertanggungjawabkan, serta dimungkinkan dalam peraturan sektoral.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_13" id="checklist_13" {{ $kriteria->checklist_13 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_13">Penyedia Barang/Jasa adalah BUMN, Anak Perusahaan PLN/Anak Perusahaan BUMN atau Perusahaan Terafiliasi PLN/Perusahaan Terafiliasi BUMN, sepanjang barang dan/atau jasa dimaksud adalah merupakan produk atau layanan BUMN, Anak Perusahaan PLN/Aanak Perusahaan BUMN, Perusahaan Terafiliasi PLN/Perusahaan Teafiliasi BUMN, dan/atau usaha kecil dan mikro, sepanjang kualitas, harga, dan tujuannya dapat dipertanggungjawabkan, serta dimungkinkan dalam peraturan sektoral.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_14" id="checklist_14" {{ $kriteria->checklist_14 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_14">Penunjukkan berulang (repeat order) dengan ketentuan sbb:
                                    1. Penyedia Barang/Jasa yang telah memenangkan tender terbatas/tender terbuka/penunjukkan langsung dengan metode open book terhadap barang yang secara terus menerus dibutuhkan sepanjang harga yang ditawarkan menguntungkan dengan kualitas barang sama atau lebih baik dan dilengkap dan dilengkapi dengan kajian yang disahkan oleh Pengguna Barang/Jasa.
                                    2. Penyedia Barang/Jasa yang telah memenangkan tender terbatas/tender terbuka terhadap jasa lainnya yang secara terus menerus dibutuhkan sepanjang harga yang ditawarkan menguntungkan dengan kualitas jasa sama atau lebih baik dan dilengkapi dengan kajian yang disahkan oleh pengguna Barang/Jasa, hanya dapat dilakukan sebanyak tiga kali berturut-turut.
                                    3. Pengguna Barang/Jasa yang telah memenangkan tender terbatas/tender terbuka dan Perjanjian/Kontraknya jangka panjang, terhadap jasa lainnya yang terus menerus dibutuhkan sepanjang harga yang ditawarkan menguntungkan dengan kualitas jasa sama atau lebih baik dan dilengkapi dengan kajian yang disahkan oleh Pengguna Barang/Jasa, dapat dilakukan satu kali dengan jangka waktu maksimal sama dengan Perjanjian/Kontrak jangka panjaang sebelumnya.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_15" id="checklist_15" {{ $kriteria->checklist_15 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_15">Penyelenggaraan fasilitas pemeliharaan kesehatan bagi pegawai dan keluarga yang ditanggung termasuk tetapi tidak terbatas pada rumah sakit, klinik, dokter, apotek, dan laboratorium.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_16" id="checklist_16" {{ $kriteria->checklist_16 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_16">Pengadaan Barang/Jasa dengan nilai tertentu ditetapkan oleh Direksi dengan terlebih dahulu mendapat review dan rekomendasi dari komite Value for Money.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_17" id="checklist_17" {{ $kriteria->checklist_17 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_17">Atas pertimbangan adanya peluang bisnis yang dapat dipertanggung jawabkan secara profesional oleh Direksi untuk melakukan Pengadaan Barang/Jasa melalui penunjukkan langsung.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_18" id="checklist_18" {{ $kriteria->checklist_18 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_18">Penyedia BarangJasa merupakan badan usaha/unit usaha yang sahamnya minimum 90% dimiliki oleh DP-PLN atau YPK-PLN atau gabungan DP-PLN/YPK-PLN dengan anak perusahaan PLN, sepanjang barang/jasa dimaksud merupakan produk atau layanan badan usaha/unit usaha tersebut.</label>
                            </div>
                        </div>
                        @else
                        <div class="form-group" for="kriteria-jasa" name="kriteria-jasa" id="kriteria-jasa">
                            <h3>Kriteria</h3>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_19" id="checklist_19" {{ $kriteria->checklist_19 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_19">Jasa yang akan diadakan bersifat spesifik hanya dapat dilaksanakan dengan menggunakna teknologi khusus oleh pemegang Hak Atas Kekayaan Intelektual (HAKI) dan/atau hanya ada 1 (satu) penyedia jasa konsultansi yang mampu melaksanakan.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_20" id="checklist_20" {{ $kriteria->checklist_20 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_20">Pekerjaan emergency.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_21" id="checklist_21" {{ $kriteria->checklist_21 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_21">Konsultan hukum untuk mendampingi pemeriksaan instansi yang berwenang, ketika dalam hal terjadi dugaan tindak pidana yang dilakukan oleh Direksi, Dewan Komisaris, atau Karyawan yang menurut pertimbangan Direksi perlu didampingi.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_22" id="checklist_22" {{ $kriteria->checklist_22 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_22">Pekerjaan penelitian/studi/pendidikan dan pelatihan/pemrosesan data yang dilakukan oleh perguruan tinggi/afiliasi perguruan tinggi, pejabat negara dan lembaga/instansi pemerintah.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_23" id="checklist_23" {{ $kriteria->checklist_23 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_23">Penasehat ahli direksi yang melakukan pekerjaan yang bersifat khusus seperti penasehat bisnis, konsultan hukum korporat, accounting, pajak atau bidang khusus lainnya yang ditentukan oleh Direksi.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_24" id="checklist_24" {{ $kriteria->checklist_24 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_24">Pengadaan jasa hukum terdiri dari:
                                    1. Konsultansi hukum untuk operasional bisnis PT. MCTN termasuk tetapi tidak terbatas pada konsultansi untuk perundingan Perjanjian/Kontrak, penyusunan atau pelaksanaan peraturan perusahaan maupun peraturan perundang-undangan.
                                    2. Bantuan hukum oleh advokat/lawyer dalam rangka membela/melindungi hak hak hukum dan kepentingan hukum PT.MCTN, Direksi/Mantan Direksi, Dewan Komisaris/Mantan Dewi Komisaris atau Pegawai/Pensiunan yang semata-mata menjalankan tugas dan/atau tindakan untuk kepentingan PT.MCTN.
                                    3. Notaris/Pejabat Pembuat Akta Tanah (PPAT)
                                    4. Jasa Penilai Publik.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_25" id="checklist_25" {{ $kriteria->checklist_25 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_25">Hasil prakualifikasi ulang, ternyata hanya ada satu konsultan mendaftar atau yang lulus prakualifikasi untuk penawaran yang masuk.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_26" id="checklist_26" {{ $kriteria->checklist_26 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_26">Penunjukkan berulang (repeat order) kepada penyedia jasa konsultansi, sepanjang harga yang ditawarkan menguntungkan dengan kualitas sama atau lebih baik. </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_27" id="checklist_27" {{ $kriteria->checklist_27 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_27">Jasa lanjutan yang secara teknis merupakan satu kesatuan yang sifatnya tidak dapat dipecah-pecah dari pekerjaan yang sudah dilaksanakan sebelumnya.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_28" id="checklist_28" {{ $kriteria->checklist_28 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_28">Jasa lanjutan yang secara teknis merupakan satu kesatuan yang sifatnya tidak dapat dipecah-pecah dari pekerjaan yang sudah dilaksanakan sebelumnya.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_29" id="checklist_29" {{ $kriteria->checklist_29 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_29">Pengadaan Jasa Konsultansi dengan nilai pengadaan sampai dengan Rp500.000.000,00 (Lima Ratus Juta Rupah).</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_30" id="checklist_30" {{ $kriteria->checklist_30 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_30">Penyedia Barang/Jasa adalah BUMN, Anak Perusahaan PLN/Anak Perusahaan BUMN atau Perusahaan Terafiliasi PLN/Perusahaan Terafiliasi BUMN, usaha kecil dan mikro, dengan ketentuan sebagai berikut..
                                    a. Bergerak dalam bidang jasa konsultansi
                                    b. Kualitas dan harga dapat dipertanggung-jawabkan.
                                    c. Dimungkinkan dalam peraturan sektoral.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_31" id="checklist_31" {{ $kriteria->checklist_31 == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="checklist_31">Apabila terdapat kriteria yang belum diatur sebagaimana pada butir 1) sd 15) ayat 4.2.8.1, pasal ini maka harus melalui persetujuan Direksi.</label>
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="divisiUser1">Dikirim Kepada :</label>
                            <select name="divisiUser1" id="divisiUser1" class="form-control" required>
                                <option value=""> </option>
                                @foreach($divisi1Options as $option)
                                <option value="{{ $option->name }}" {{ old('divisiUser1', $divisiUser1) == $option->name ? 'selected' : '' }}>
                                    {{ $option->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js"></script>
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

<script>
document.addEventListener("DOMContentLoaded", function() {
 
    // Ambil elemen select jenis_pengadaan
    const jenisPengadaanSelect = document.getElementById("jenis_pengadaan");

    // Ambil elemen formulir URL KAK dan URL Spesifikasi Teknis
    const kriteriaJasa = document.getElementById("kriteria-jasa");
    const kriteriaBarang = document.getElementById("kriteria-barang");

    // Tambahkan event listener untuk perubahan pada jenis_pengadaan
    jenisPengadaanSelect.addEventListener("change", function() {

        kriteriaJasa.style.display = "none";
        kriteriaBarang.style.display = "none";

        // Tampilkan elemen yang sesuai dengan jenis_pengadaan
        if (jenisPengadaanSelect.value === "Jasa Konsultasi") {
            kriteriaJasa.style.display = "block";
        } else if (jenisPengadaanSelect.value === "Jasa Konstruksi" || jenisPengadaanSelect.value === "Barang" || jenisPengadaanSelect.value === "Jasa Lainnya" || jenisPengadaanSelect.value === "Pengadaan Khusus") {
            kriteriaBarang.style.display = "block";
        }
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

