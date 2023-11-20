@extends('dashboard.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header"><center>{{ __('JUSTIFIKASI PENUNJUKAN LANGSUNG') }}</center></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('justifikasi.store') }}">
                        @csrf

                        <div class="d-flex justify-content-between">
                            <h3>Nama Pekerjaan: {{ $pengadaan->Judul_Pengadaan }}</h3>
                        </div>

                        <div class="form-group">
                            <label for="Jenis_Pengadaan">Jenis Pengadaan</label>
                            <select name="Jenis_Pengadaan" id="Jenis_Pengadaan" class="form-control" required>
                                <option value=""> </option>
                                @foreach($jenisPengadaanOptions as $option)
                                    <option value="{{ $option->Jenis_Pengadaan }}" {{ $jenisPengadaan && $option->Jenis_Pengadaan == $jenisPengadaan->id ? 'selected' : '' }}>
                                        {{ $option->Jenis_Pengadaan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Nama_Peserta">Peserta Penunjukan Langsung</label>
                            <select name="Nama_Peserta" id="Nama_Peserta" class="form-control" required>
                                @foreach($namaPesertaOptions as $option)
                                    <option value="{{ $option->id }}" {{ $namaPeserta && $option->id == $namaPeserta->id ? 'selected' : '' }}>
                                        {{ $option->Nama_Peserta }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Pagu_Anggaran">Pagu Anggaran</label>
                            <input type="number" step="any" name="Pagu_Anggaran" id="Pagu_Anggaran" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <h3 for="ringkasan_pekerjaan">Ringkasan Kondisi</h3>
                            <label>Bagaimana status kondisi saat ini dan aktivitas apa yang mengakibatkan dibutuhkannya Penunjukan Langsung ini?</label>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="ringkasan_pekerjaan"></textarea>
                            </div>

                            <label>Mengapa metode Penunjukan Langsung yang dipilih?</label>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="ringkasan_pekerjaan"></textarea>
                            </div>

                            <label>Apa kriteria yang digunakan untuk memilih Peserta Tender terpilih?(Teknis)</label>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="ringkasan_pekerjaan"></textarea>
                            </div>

                            <label>Apa kriteria yang digunakan untuk memilih Peserta Tender terpilih?(Komersial)</label>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="ringkasan_pekerjaan"></textarea>
                            </div>

                            <label>Apa kriteria yang digunakan untuk memilih Peserta Tender terpilih?(Lainnya)</label>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="ringkasan_pekerjaan"></textarea>
                            </div>
                        </div>

                        <div class="form-group" for="kriteria-barang" name="kriteria-barang" id="kriteria-barang" style="display: none;">
                            <h3>Kriteria</h3>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_1" id="checklist-1">
                                <label class="form-check-label" for="checklist-1">Pengadaan barang, pekerjaan konstruksi, jasa lainnya yang bersifat spesifik,
                                    1. Barang yang dibutuhkan, hanya diproduksi oleh satu pabrik tertentu
                                    2. Satu-satunya pabrik pemiliki jaminan (warranty) dari Original Equipment Manufacture (OEM)
                                    3. Pekerjaan yang akan dilaksanakan hanya dapat dilakukan oleh pemegang hak intelektual (HAKI)</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_2" id="checklist-2">
                                <label class="form-check-label" for="checklist-2">Hanya terdapat satu penyedia barang/jasa yang dapat melaksanakan pekerjaan sesuai dengan kebutuhan Pengguna Barang/Jasa</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_3" id="checklist-3">
                                <label class="form-check-label" for="checklist-3">Penyedia Barang/Jasa adalah lembaga negara, pejabat negara, perguruan tinggi dan afiliasinya.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_4" id="checklist-4">
                                <label class="form-check-label" for="checklist-4">Pengadaan Barang/Jasa yang ditender ulang mengalami kegagalan.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_5" id="checklist-5">
                                <label class="form-check-label" for="checklist-5">Pekerjaan penugasan dari Direksi atas penugasan pemerintah dalam rangka pembangunan infrastruktur ketenagalistrikan</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_6" id="checklist-6">
                                <label class="form-check-label" for="checklist-6">Untuk melaksanakan proyek pengembangan teknologi</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_7" id="checklist-7">
                                <label class="form-check-label" for="checklist-7">Dalam rangka National Capacity Building (NCB)</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_8" id="checklist-8">
                                <label class="form-check-label" for="checklist-8">Pemeliharaan unit pembangkit dalam bentuk kesepakatan jangka panjang/Long Term Service/Supply Agreement (LTSA)</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_9" id="checklist-9">
                                <label class="form-check-label" for="checklist-9">Pekerjaan akibat bencana alam baik lokal maupun nasional (force majeure)</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_10" id="checklist-10">
                                <label class="form-check-label" for="checklist-10">Pekerjaan darurat (emergency) untuk keamanan dan keselamatan masyarakat dan aset strategis perusahaan.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_11" id="checklist-11">
                                <label class="form-check-label" for="checklist-11">Pemberian bantuan bencana alam dan/atau untuk Corporate Social Responsibility (CSR).</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_12" id="checklist-12">
                                <label class="form-check-label" for="checklist-12">Penyedia Barang/Jasa adalah BUMN, Anak Perusahaan PLN/Anak Perusahaan BUMN atau Perusahaan Terafiliasi PLN/Perusahaan Terafiliasi BUMN, sepanjang barang dan/atau jasa dimaksud adalah merupakan produk atau layanan BUMN, Anak Perusahaan PLN/Anak Perusahaan BUMN, Perusahaan Terafiliasi PLN/Perusahaan Teafiliasi BUMN, dan/atau usaha kecil dan mikro, sepanjang kualitas, harga, dan tujuannya dapat dipertanggungjawabkan, serta dimungkinkan dalam peraturan sektoral.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_13" id="checklist-13">
                                <label class="form-check-label" for="checklist-13">Penyedia Barang/Jasa adalah BUMN, Anak Perusahaan PLN/Anak Perusahaan BUMN atau Perusahaan Terafiliasi PLN/Perusahaan Terafiliasi BUMN, sepanjang barang dan/atau jasa dimaksud adalah merupakan produk atau layanan BUMN, Anak Perusahaan PLN/Aanak Perusahaan BUMN, Perusahaan Terafiliasi PLN/Perusahaan Teafiliasi BUMN, dan/atau usaha kecil dan mikro, sepanjang kualitas, harga, dan tujuannya dapat dipertanggungjawabkan, serta dimungkinkan dalam peraturan sektoral.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_14" id="checklist-14">
                                <label class="form-check-label" for="checklist-14">Penunjukkan berulang (repeat order) dengan ketentuan sbb:
                                    1. Penyedia Barang/Jasa yang telah memenangkan tender terbatas/tender terbuka/penunjukkan langsung dengan metode open book terhadap barang yang secara terus menerus dibutuhkan sepanjang harga yang ditawarkan menguntungkan dengan kualitas barang sama atau lebih baik dan dilengkap dan dilengkapi dengan kajian yang disahkan oleh Pengguna Barang/Jasa.
                                    2. Penyedia Barang/Jasa yang telah memenangkan tender terbatas/tender terbuka terhadap jasa lainnya yang secara terus menerus dibutuhkan sepanjang harga yang ditawarkan menguntungkan dengan kualitas jasa sama atau lebih baik dan dilengkapi dengan kajian yang disahkan oleh pengguna Barang/Jasa, hanya dapat dilakukan sebanyak tiga kali berturut-turut.
                                    3. Pengguna Barang/Jasa yang telah memenangkan tender terbatas/tender terbuka dan Perjanjian/Kontraknya jangka panjang, terhadap jasa lainnya yang terus menerus dibutuhkan sepanjang harga yang ditawarkan menguntungkan dengan kualitas jasa sama atau lebih baik dan dilengkapi dengan kajian yang disahkan oleh Pengguna Barang/Jasa, dapat dilakukan satu kali dengan jangka waktu maksimal sama dengan Perjanjian/Kontrak jangka panjaang sebelumnya.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_15" id="checklist-15">
                                <label class="form-check-label" for="checklist-15">Penyelenggaraan fasilitas pemeliharaan kesehatan bagi pegawai dan keluarga yang ditanggung termasuk tetapi tidak terbatas pada rumah sakit, klinik, dokter, apotek, dan laboratorium.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_16" id="checklist-16">
                                <label class="form-check-label" for="checklist-16">Pengadaan Barang/Jasa dengan nilai tertentu ditetapkan oleh Direksi dengan terlebih dahulu mendapat review dan rekomendasi dari komite Value for Money.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_17" id="checklist-17">
                                <label class="form-check-label" for="checklist-17">Atas pertimbangan adanya peluang bisnis yang dapat dipertanggung jawabkan secara profesional oleh Direksi untuk melakukan Pengadaan Barang/Jasa melalui penunjukkan langsung.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_18" id="checklist-18">
                                <label class="form-check-label" for="checklist-18">Penyedia BarangJasa merupakan badan usaha/unit usaha yang sahamnya minimum 90% dimiliki oleh DP-PLN atau YPK-PLN atau gabungan DP-PLN/YPK-PLN dengan anak perusahaan PLN, sepanjang barang/jasa dimaksud merupakan produk atau layanan badan usaha/unit usaha tersebut.</label>
                            </div>
                        </div>

                        <div class="form-group" for="kriteria-jasa" name="kriteria-jasa" id="kriteria-jasa" style="display: none;">
                            <h3>Kriteria</h3>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_19" id="checklist-19">
                                <label class="form-check-label" for="checklist-19">Jasa yang akan diadakan bersifat spesifik hanya dapat dilaksanakan dengan menggunakna teknologi khusus oleh pemegang Hak Atas Kekayaan Intelektual (HAKI) dan/atau hanya ada 1 (satu) penyedia jasa konsultansi yang mampu melaksanakan</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_20" id="checklist-20">
                                <label class="form-check-label" for="checklist-20">Pekerjaan emergency</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_21" id="checklist-21">
                                <label class="form-check-label" for="checklist-21">Konsultan hukum untuk mendampingi pemeriksaan instansi yang berwenang, ketika dalam hal terjadi dugaan tindak pidana yang dilakukan oleh Direksi, Dewan Komisaris, atau Karyawan yang menurut pertimbangan Direksi perlu didampingi</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_22" id="checklist-22">
                                <label class="form-check-label" for="checklist-22">Pekerjaan penelitian/studi/pendidikan dan pelatihan/pemrosesan data yang dilakukan oleh perguruan tinggi/afiliasi perguruan tinggi, pejabat negara dan lembaga/instansi pemerintah.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_23" id="checklist-23">
                                <label class="form-check-label" for="checklist-23">Penasehat ahli direksi yang melakukan pekerjaan yang bersifat khusus seperti penasehat bisnis, konsultan hukum korporat, accounting, pajak atau bidang khusus lainnya yang ditentukan oleh Direksi.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_24" id="checklist-24">
                                <label class="form-check-label" for="checklist-24">Pengadaan jasa hukum terdiri dari:
                                    1. Konsultansi hukum untuk operasional bisnis PT. MCTN termasuk tetapi tidak terbatas pada konsultansi untuk perundingan Perjanjian/Kontrak, penyusunan atau pelaksanaan peraturan perusahaan maupun peraturan perundang-undangan.
                                    2. Bantuan hukum oleh advokat/lawyer dalam rangka membela/melindungi hak hak hukum dan kepentingan hukum PT.MCTN, Direksi/Mantan Direksi, Dewan Komisaris/Mantan Dewi Komisaris atau Pegawai/Pensiunan yang semata-mata menjalankan tugas dan/atau tindakan untuk kepentingan PT.MCTN.
                                    3. Notaris/Pejabat Pembuat Akta Tanah (PPAT)
                                    4. Jasa Penilai Publik.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_25" id="checklist-25">
                                <label class="form-check-label" for="checklist-25">Hasil prakualifikasi ulang, ternyata hanya ada satu konsultan mendaftar atau yang lulus prakualifikasi untuk penawaran yang masuk</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_26" id="checklist-26">
                                <label class="form-check-label" for="checklist-26">Penunjukkan berulang (repeat order) kepada penyedia jasa konsultansi, sepanjang harga yang ditawarkan menguntungkan dengan kualitas sama atau lebih baik. </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_27" id="checklist-27">
                                <label class="form-check-label" for="checklist-27">Jasa lanjutan yang secara teknis merupakan satu kesatuan yang sifatnya tidak dapat dipecah-pecah dari pekerjaan yang sudah dilaksanakan sebelumnya.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_28" id="checklist-28">
                                <label class="form-check-label" for="checklist-28">Jasa lanjutan yang secara teknis merupakan satu kesatuan yang sifatnya tidak dapat dipecah-pecah dari pekerjaan yang sudah dilaksanakan sebelumnya.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_29" id="checklist-29">
                                <label class="form-check-label" for="checklist-29">Pengadaan Jasa Konsultansi dengan nilai pengadaan sampai dengan Rp500.000.000,00 (Lima Ratus Juta Rupah)</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_30" id="checklist-30">
                                <label class="form-check-label" for="checklist-30">Penyedia Barang/Jasa adalah BUMN, Anak Perusahaan PLN/Anak Perusahaan BUMN atau Perusahaan Terafiliasi PLN/Perusahaan Terafiliasi BUMN, usaha kecil dan mikro, dengan ketentuan sebagai berikut..
                                    a. Bergerak dalam bidang jasa konsultansi
                                    b. Kualitas dan harga dapat dipertanggung-jawabkan.
                                    c. Dimungkinkan dalam peraturan sektoral.</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="checklist_31" id="checklist-31">
                                <label class="form-check-label" for="checklist-31">Apabila terdapat kriteria yang belum diatur sebagaimana pada butir 1) sd 15) ayat 4.2.8.1, pasal ini maka harus melalui persetujuan Direksi.</label>
                            </div>
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
    const jenisPengadaanSelect = document.getElementById("Jenis_Pengadaan");

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

