@php
    // Import namespace di luar blok PHP
    use Illuminate\Support\Facades\File;

    // Lanjutkan dengan penggunaan normal
    if ($justifikasi->tanda_tangan_user_1) {
        $imagePath = public_path('storage/' . $justifikasi->tanda_tangan_user_1);
        $imageData = base64_encode(File::get($imagePath));
        $imageMimeType = mime_content_type($imagePath);
    }
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUSTIFIKASI UNTUK PENUNJUKAN LANGSUNG</title>
</head>
<style>
    table {
    width: 100%;
    max-width: 800px;
    border-collapse: collapse;
    margin-bottom: 20px;
    overflow-x: auto;
}
</style>

<body>
    <div style="float: left; margin-right: 10px;">
        <img src="data:image/{{ $types }};base64,{{ $base64Image }}" alt="Logo" width="120">
    </div>
    <h4><center>JUSTIFIKASI UNTUK PENUNJUKAN LANGSUNG</center></h4>
    <br>
    <div>
        <br>
        <P>Penunjukan Langsung Untuk : <b>{{ $pengadaan->Judul_Pengadaan }}</b></P>
        <P>Jenis Pengadaan : <b>{{ $jenisPengadaan->Jenis_Pengadaan }}</b></P>
        <P>Pagu Anggaran : <b>Rp {{ $justifikasi->pagu_anggaran }}</b></P>
        <P>Peserta Penunjukan Langsung : <b>{{ $justifikasi->nama_perusahaan }}</b></P>
        <br>
        <table border="1" cellpadding="3">
            <tbody>
        <p>&nbsp;Bagaimana status kondisi saat ini dan aktivitas apa yang mengakibatkan dibutuhkannya Penunjukan &nbsp;Langsung ini?&nbsp;</p>
        <p style="font-size: 10px"><i><b>&nbsp;Note : (Silahkan Uraikan dan Jelaskan Lebih Rinci)</i></b></p>(Silahkan Uraikan dan Jelaskan Lebih Rinci)
        <hr />
        <p>&nbsp;{{ $justifikasi->Rincian_Status_Kondisi }}&nbsp;</p>
            </tbody>
        </table>

        <table border="1" cellpadding="3">
            <tbody>
        <p>&nbsp;Mengapa metode Penunjukan Langsung yang dipilih?&nbsp;</p>
        <p style="font-size: 10px"><i><b>&nbsp;Note : (Silahkan Uraikan dan Jelaskan Lebih Rinci)</i></b></p>
        <hr />
        <p>&nbsp;{{ $justifikasi->Rincian_Alasan_Metode }}&nbsp;</p>
            </tbody>
        </table>

        <table border="1" cellpadding="3">
            <tbody>
        <p>&nbsp;Apa kriteria yang digunakan untuk memilih Peserta Tender terpilih?(Teknis)&nbsp;</p>
        <p style="font-size: 10px"><i><b>&nbsp;Note : (Silahkan Uraikan dan Jelaskan Lebih Rinci)</i></b></p>
        <hr />
        <p>&nbsp;{{ $justifikasi->Rincian_Kriteria_Peserta_Teknis }}&nbsp;</p>
            </tbody>
        </table>

        <table border="1" cellpadding="3">
            <tbody>
        <p>&nbsp;Apa kriteria yang digunakan untuk memilih Peserta Tender terpilih?(Komersial)&nbsp;</p>
        <p style="font-size: 10px"><i><b>&nbsp;Note : (Silahkan Uraikan dan Jelaskan Lebih Rinci)</i></b></p>
        <hr />
        <p>&nbsp;{{ $justifikasi->Rincian_Kriteria_Peserta_Komersial }}&nbsp;</p>
            </tbody>
        </table>

        <table border="1" cellpadding="3">
            <tbody>
        <p>&nbsp;Apa kriteria yang digunakan untuk memilih Peserta Tender terpilih?(Lainnya)&nbsp;</p>
        <p style="font-size: 10px"><i><b>&nbsp;Note : (Silahkan Uraikan dan Jelaskan Lebih Rinci)</i></b></p>
        <hr />
        <p>&nbsp;{{ $justifikasi->Rincian_Kriteria_Peserta_Lainnya }}&nbsp;</p>
            </tbody>
        </table>

        <table border="1">
            @if ($jenisPengadaan->ID_Jenis_Pengadaan != 4)
            <tbody>
                <tr>
                    <th>Kriteria</th>
                </tr>
                @php
                $checklistNames = [
                    "Pengadaan barang, pekerjaan konstruksi, jasa lainnya yang bersifat spesifik,
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. Barang yang dibutuhkan, hanya diproduksi oleh satu pabrik tertentu,
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Satu-satunya pabrik pemiliki jaminan (warranty) dari Original Equipment Manufacture (OEM),
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. Pekerjaan yang akan dilaksanakan hanya dapat dilakukan oleh pemegang hak intelektual (HAKI).",
                    
                    "Hanya terdapat satu penyedia barang/jasa yang dapat melaksanakan pekerjaan sesuai dengan kebutuhan &nbsp;&nbsp;&nbsp;&nbsp;Pengguna Barang/Jasa",
                    
                    "Penyedia Barang/Jasa adalah lembaga negara, pejabat negara, perguruan tinggi dan afiliasinya.",
                    
                    "Pengadaan Barang/Jasa yang ditender ulang mengalami kegagalan.",
                    
                    "Pekerjaan penugasan dari Direksi atas penugasan pemerintah dalam rangka pembangunan infrastruktur  &nbsp;&nbsp;&nbsp;&nbsp;ketenagalistrikan.",
                    
                    "Untuk melaksanakan proyek pengembangan teknologi.",
                    
                    "Dalam rangka National Capacity Building (NCB).",
                    
                    "Pemeliharaan unit pembangkit dalam bentuk kesepakatan jangka panjang/Long Term Service/Supply  &nbsp;&nbsp;&nbsp;&nbsp;Agreement (LTSA)",
                    
                    "Pekerjaan akibat bencana alam baik lokal maupun nasional (force majeure).",
                    
                    "Pekerjaan darurat (emergency) untuk keamanan dan keselamatan masyarakat dan aset strategis  &nbsp;&nbsp;&nbsp;&nbsp;perusahaan.",
                    
                    "Pemberian bantuan bencana alam dan/atau untuk Corporate Social Responsibility (CSR).",
                    
                    "Penyedia Barang/Jasa adalah BUMN, Anak Perusahaan PLN/Anak Perusahaan BUMN atau Perusahaan &nbsp;&nbsp;&nbsp;&nbsp;Terafiliasi PLN/Perusahaan Terafiliasi BUMN, sepanjang barang dan/atau jasa dimaksud adalah &nbsp;&nbsp;&nbsp;&nbsp;merupakan produk atau layanan BUMN, Anak Perusahaan PLN/Anak Perusahaan BUMN, Perusahaan &nbsp;&nbsp;&nbsp;&nbsp;Terafiliasi PLN/Perusahaan Teafiliasi BUMN, dan/atau usaha kecil dan mikro, sepanjang kualitas, harga, &nbsp;&nbsp;&nbsp;&nbsp;dan tujuannya dapat dipertanggungjawabkan, serta dimungkinkan dalam peraturan sektoral.",
                    
                    "Penyedia Barang/Jasa adalah BUMN, Anak Perusahaan PLN/Anak Perusahaan BUMN atau Perusahaan &nbsp;&nbsp;&nbsp;&nbsp;Terafiliasi PLN/Perusahaan Terafiliasi BUMN, sepanjang barang dan/atau jasa dimaksud adalah &nbsp;&nbsp;&nbsp;&nbsp;merupakan produk atau layanan BUMN, Anak Perusahaan PLN/Anak Perusahaan BUMN, Perusahaan &nbsp;&nbsp;&nbsp;&nbsp;Terafiliasi PLN/Perusahaan Teafiliasi BUMN, dan/atau usaha kecil dan mikro, sepanjang kualitas, harga, &nbsp;&nbsp;&nbsp;&nbsp;dan tujuannya dapat dipertanggungjawabkan, serta dimungkinkan dalam peraturan sektoral.",
                ];
                echo "<div class='form-group' for='kriteria-barang' name='kriteria-barang' id='kriteria-barang'>";
                    foreach ($checklistNames as $i => $checklistName) {
                    $checklistColumn = "checklist_" . ($i + 1);

                echo "<div class='form-check' style='margin-top: 10px;'>";
                echo "<input type='checkbox' class='form-check-input' name='checklist_$i' id='checklist_$i' " . ($kriteria->$checklistColumn == 1 ? 'checked' : '') . ">";
                echo "<label class='form-check-label' for='checklist_$i'>$checklistName</label>";
                echo "</div>";
                }
                echo "</div>";
                @endphp
                </tbody>
                <tbody>
                @php
                    $checklistNames2 = [
                    "Penunjukkan berulang (repeat order) dengan ketentuan sbb:
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. Penyedia Barang/Jasa yang telah memenangkan tender terbatas/tender terbuka/penunjukkan langsung &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dengan metode open book terhadap barang yang secara terus menerus dibutuhkan sepanjang harga &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;yang ditawarkan menguntungkan dengan kualitas barang sama atau lebih baik dan dilengkap dan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dilengkapi dengan kajian yang disahkan oleh Pengguna Barang/Jasa.
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Penyedia Barang/Jasa yang telah memenangkan tender terbatas/tender terbuka terhadap jasa lainnya &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;yang secara terus menerus dibutuhkan sepanjang harga yang ditawarkan menguntungkan dengan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;kualitas jasa sama atau lebih baik dan dilengkapi dengan kajian yang disahkan oleh pengguna &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Barang/Jasa, hanya dapat dilakukan sebanyak tiga kali berturut-turut.
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. Pengguna Barang/Jasa yang telah memenangkan tender terbatas/tender terbuka dan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Perjanjian/Kontraknya jangka panjang, terhadap jasa lainnya yang terus menerus dibutuhkan sepanjang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;harga yang ditawarkan menguntungkan dengan kualitas jasa sama atau lebih baik dan dilengkapi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dengan kajian yang disahkan oleh Pengguna Barang/Jasa, dapat dilakukan satu kali dengan jangka &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;waktu maksimal sama dengan Perjanjian/Kontrak jangka panjaang sebelumnya.",
                    
                    "Penyelenggaraan fasilitas pemeliharaan kesehatan bagi pegawai dan keluarga yang ditanggung termasuk &nbsp;&nbsp;&nbsp;&nbsp;tetapi tidak terbatas pada rumah sakit, klinik, dokter, apotek, dan laboratorium.",
                    
                    "Pengadaan Barang/Jasa dengan nilai tertentu ditetapkan oleh Direksi dengan terlebih dahulu mendapat &nbsp;&nbsp;&nbsp;&nbsp;review dan rekomendasi dari komite Value for Money.",
                    
                    "Atas pertimbangan adanya peluang bisnis yang dapat dipertanggung jawabkan secara profesional oleh &nbsp;&nbsp;&nbsp;&nbsp;Direksi untuk melakukan Pengadaan Barang/Jasa melalui penunjukkan langsung.",
                    
                    "Penyedia BarangJasa merupakan badan usaha/unit usaha yang sahamnya minimum 90% dimiliki oleh DP-&nbsp;&nbsp;&nbsp;&nbsp;PLN atau YPK-PLN atau gabungan DP-PLN/YPK-PLN dengan anak perusahaan PLN, sepanjang &nbsp;&nbsp;&nbsp;&nbsp;barang/jasa dimaksud merupakan produk atau layanan badan usaha/unit usaha tersebut.",
                    
                ];
                echo "<div class='form-group2' for='kriteria-barang2' name='kriteria-barang2' id='kriteria-barang2'>";
                    foreach ($checklistNames2 as $i => $checklistName2) {
                    $checklistColumn = "checklist_" . ($i + 13);

                echo "<div class='form-check2' style='margin-top: 10px;'>";
                echo "<input type='checkbox' class='form-check-input2' name='checklist_$i' id='checklist_$i' " . ($kriteria->$checklistColumn == 1 ? 'checked' : '') . ">";
                echo "<label class='form-check-label2' for='checklist_$i'>$checklistName2</label>";
                echo "</div>";
                }
                echo "</div>";
                @endphp
            </tbody>
            @else
            <tbody>
                <tr>
                    <th>Kriteria</th>
                </tr>
                @php
                    $checklistNames3 = [
                    "Jasa yang akan diadakan bersifat spesifik hanya dapat dilaksanakan dengan menggunakna teknologi &nbsp;&nbsp;&nbsp;&nbsp;khusus oleh pemegang Hak Atas Kekayaan Intelektual (HAKI) dan/atau hanya ada 1 (satu) penyedia &nbsp;&nbsp;&nbsp;&nbsp;jasa konsultansi yang mampu melaksanakan.",
                    
                    "Pekerjaan emergency.",
                    
                    "Konsultan hukum untuk mendampingi pemeriksaan instansi yang berwenang, ketika dalam hal terjadi &nbsp;&nbsp;&nbsp;&nbsp;dugaan tindak pidana yang dilakukan oleh Direksi, Dewan Komisaris, atau Karyawan yang menurut &nbsp;&nbsp;&nbsp;&nbsp;pertimbangan Direksi perlu didampingi.",
                    
                    "Pekerjaan penelitian/studi/pendidikan dan pelatihan/pemrosesan data yang dilakukan oleh perguruan &nbsp;&nbsp;&nbsp;&nbsp;tinggi/afiliasi perguruan tinggi, pejabat negara dan lembaga/instansi pemerintah.",
                    
                    "Penasehat ahli direksi yang melakukan pekerjaan yang bersifat khusus seperti penasehat bisnis, konsultan &nbsp;&nbsp;&nbsp;&nbsp;hukum korporat, accounting, pajak atau bidang khusus lainnya yang ditentukan oleh Direksi.",
                    
                    "Pengadaan jasa hukum terdiri dari:
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. Konsultansi hukum untuk operasional bisnis PT. MCTN termasuk tetapi tidak terbatas pada konsultansi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;untuk perundingan Perjanjian/Kontrak, penyusunan atau pelaksanaan peraturan perusahaan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;maupun peraturan perundang-undangan.
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Bantuan hukum oleh advokat/lawyer dalam rangka membela/melindungi hak hak hukum dan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;kepentingan hukum PT.MCTN, Direksi/Mantan Direksi, Dewan Komisaris/Mantan Dewi Komisaris &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;atau Pegawai/Pensiunan yang semata-mata menjalankan tugas dan/atau tindakan untuk kepentingan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PT.MCTN.
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. Notaris/Pejabat Pembuat Akta Tanah (PPAT)
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. Jasa Penilai Publik.",
                    
                    "Hasil prakualifikasi ulang, ternyata hanya ada satu konsultan mendaftar atau yang lulus prakualifikasi &nbsp;&nbsp;&nbsp;&nbsp;untuk penawaran yang masuk.",
                    
                    "Penunjukkan berulang (repeat order) kepada penyedia jasa konsultansi, sepanjang harga yang ditawarkan &nbsp;&nbsp;&nbsp;&nbsp;menguntungkan dengan kualitas sama atau lebih baik.",
                    
                    "Jasa lanjutan yang secara teknis merupakan satu kesatuan yang sifatnya tidak dapat dipecah-pecah dari &nbsp;&nbsp;&nbsp;&nbsp;pekerjaan yang sudah dilaksanakan sebelumnya.",
                    
                    "Jasa lanjutan yang secara teknis merupakan satu kesatuan yang sifatnya tidak dapat dipecah-pecah dari &nbsp;&nbsp;&nbsp;&nbsp;pekerjaan yang sudah dilaksanakan sebelumnya.",
                    
                    "Pengadaan Jasa Konsultansi dengan nilai pengadaan sampai dengan Rp500.000.000,00 (Lima Ratus Juta &nbsp;&nbsp;&nbsp;&nbsp;Rupah).",
                    
                    "Penyedia Barang/Jasa adalah BUMN, Anak Perusahaan PLN/Anak Perusahaan BUMN atau Perusahaan &nbsp;&nbsp;&nbsp;&nbsp;Terafiliasi PLN/Perusahaan Terafiliasi BUMN, usaha kecil dan mikro, dengan ketentuan sebagai berikut..
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Bergerak dalam bidang jasa konsultansi
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Kualitas dan harga dapat dipertanggung-jawabkan.
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c. Dimungkinkan dalam peraturan sektoral.",
                    
                    "Apabila terdapat kriteria yang belum diatur sebagaimana pada butir 1) sd 15) ayat 4.2.8.1, pasal ini maka &nbsp;&nbsp;&nbsp;&nbsp;harus melalui persetujuan Direksi.",
                ];
                echo "<div class='form-group3' for='kriteria-jasa' name='kriteria-jasa' id='kriteria-jasa'>";
                    foreach ($checklistNames3 as $i => $checklistName3) {
                    $checklistColumn = "checklist_" . ($i + 18);

                echo "<div class='form-check3' style='margin-top: 10px;'>";
                echo "<input type='checkbox' class='form-check-input3' name='checklist_$i' id='checklist_$i' " . ($kriteria->$checklistColumn == 1 ? 'checked' : '') . ">";
                echo "<label class='form-check-label3' for='checklist_$i'>$checklistName3</label>";
                echo "</div>";
                }
                echo "</div>";
                @endphp
            </tbody>
            @endif
        </table>
    </div>
    <p></p>
    <br>
<br>
    <div style="float: right; margin-right: 10px;">
        <p>@if(isset($kota))
            {{ $kota->Kota }},
        @endif{{ $tanggalFormatted }}</p>
        <p>Disetujui oleh:</p>
        <p></p>
        <div>
            @if ($justifikasi->tanda_tangan_user_1)
                <img src="data:image/{{ $imageMimeType }};base64,{{ $imageData }}" alt="Tanda Tangan" width="100">
            @else
                <p></p>
            @endif
        </div>
        <br>
        <p><b><u>{{ $justifikasi->nama_user_1 }}</u></b></p>
        <p><b>{{ $justifikasi->jabatan_user_1 }}</b></p>
    </div>
</body>

</html>
