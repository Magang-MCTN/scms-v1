@php
    // Import namespace di luar blok PHP
    use Illuminate\Support\Facades\File;

    // Lanjutkan dengan penggunaan normal
    if ($hpe->tanda_tangan_pejabat_rendan) {
        $imagePath = public_path('storage/' . $hpe->tanda_tangan_pejabat_rendan);
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
    <title>HARGA PERHITUNGAN ENJINIRING (HPE)</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    size: A4 portrait;
    font-size: 12px; /* Adjust the font size as needed */
    line-height: 1.5; /* Adjust the line height as needed */
}

/* ... other styles ... */

    table {
    width: 100%;
    max-width: 800px;
    border-collapse: collapse;
    margin-bottom: 20px;
    overflow-x: auto;
}
</style>

<body>
    <div style="float: left; margin-right: 12px;">
        <img src="data:image/{{ $types }};base64,{{ $base64Image }}" alt="Logo" width="120">
    </div>
    <p></p>
    <br>
    <p></p>
    <div>
        <p><b><i>Rahasia</i></b></p>
        <p></p>
        <div style="float: right; margin-right: 10px;">
         <p>@if(isset($kota))
        {{ $kota->Kota }},
    @endif {{ $tanggalFormatted }}</p>
        </div>
        <p></p>
        <br>
        <h5><center>HARGA PERHITUNGAN ENJINIRING (HPE)</center></h5>
        <h6><center>PENGADAAN LANGSUNG BARANG/JASA</center></h6>
        <h6><center>{{ $pengadaan->Judul_Pengadaan }}</center></h6>
        <center>
            @if ($rencanaMulaiFormatted && $rencanaSelesaiFormatted)
                <h5>Rencana Tanggal Terkontrak: <b>{{ $rencanaMulaiFormatted }} - {{ $rencanaSelesaiFormatted }}</b></h5>
            @endif
        </center>
        <center>
            @if ($pengadaan->rencana_durasi_kontrak && $pengadaan->rencana_durasi_kontrak_tanggal)
                <h5>Rencana Durasi Kontrak: <b>{{ $pengadaan->rencana_durasi_kontrak }} {{ $pengadaan->rencana_durasi_kontrak_tanggal }}</b></h5>
            @endif
        </center>
        <p></p>
        <p>Berikut terlampir usulan Harga Perhitungan Enjiniring (HPE) untuk Pengadaan Langsung tersebut di atas, yakni senilai:</p>
        <h5><center><i><b>Rp. {{ $hpe->HPE }}</b></i></center></h5>
        <p></p>
        <p>Usulan HPE tersebut di atas mempertimbangkan dan tidak melebihi nilai pagu dana sebesar :</p>
        <h5><center><i><b>Rp. {{ $notaDinasPermintaan->pagu_anggaran }}</b></i></</center></h5>
        <p></p>
    <div>
        <table border="1">
            <tbody>
                <tr>
                    <th>Sumber Referensi</th>
                </tr>
                @if ($jenisPengadaan->ID_Jenis_Pengadaan != 4)
                @php
                $checklistNames = [
                    "Informasi Harga Pabrikan/Agen Tunggal",

                    "Informasi Harga Pasar",

                    "Informasi Harga dari data Badan Pusat Statistik",

                    "Hasil Perhitungan Konsultan Enjiniring",

                    "Harga Kontrak yang lalu pada Pekerjaan yang Sejenis",
                    ];
                echo "<div class='form-group' for='sumber-referensi-barang' name='sumber-referensi-barang' id='sumber-referensi-barang'>";
                    foreach ($checklistNames as $i => $checklistName) {
                    $checklistColumn = "checklist_" . ($i + 1);

                echo "<div class='form-check' style='margin-top: 10px;'>";
                echo "<input type='checkbox' class='form-check-input' name='checklist_$i' id='checklist_$i' " . ($sumberReferensi->$checklistColumn == 1 ? 'checked' : '') . ">";
                echo "<label class='form-check-label' for='checklist_$i'>$checklistName</label>";
                echo "</div>";
                }
                echo "</div>";
                @endphp
                @else
                @php
                    $checklistNames2 = [
                    "HPE yang dimutakhirkan",

                    "Daftar renumerasi konsultas dari asosiasi",

                    "Besarnya gaji yang pernah dibayarkan",

                    "Informasi lain terkait biaya konsultas",
                ];
                echo "<div class='form-group2' for='sumber-referensi-jasa' name='sumber-referensi-jasa' id='sumber-referensi-jasa'>";
                    foreach ($checklistNames2 as $i => $checklistName2) {
                    $checklistColumn = "checklist_" . ($i + 6);

                echo "<div class='form-check2' style='margin-top: 10px;'>";
                echo "<input type='checkbox' class='form-check-input2' name='checklist_$i' id='checklist_$i' " . ($sumberReferensi->$checklistColumn == 1 ? 'checked' : '') . ">";
                echo "<label class='form-check-label2' for='checklist_$i'>$checklistName2</label>";
                echo "</div>";
                }
                echo "</div>";
                @endphp
            </tbody>
            @endif
        </table>
    </div>
    <div>
        <p>@if(isset($kota))
            {{ $kota->Kota }},
        @endif{{ $tanggalFormatted }}</p>
        <p>Disetujui oleh:</p>
        <p></p>
        <p><b>Pengguna Barang/Jasa</b></p>
        <div>
            @if ($hpe->tanda_tangan_pejabat_rendan)
                <img src="data:image/{{ $imageMimeType }};base64,{{ $imageData }}" alt="Tanda Tangan" width="100">
            @else
                <p></p>
            @endif
        </div>
        <br>
        <p><b>{{ $hpe->nama_pejabat_rendan }}</b></p>
        <p><b>{{ $hpe->jabatan_pejabat_rendan }}</b></p>
        <p><b>Lampiran : <a href="{{ asset('storage/' . $hpe->attachment_file) }}">Rincian Perhitungan HPE</a></b></p>
    </div>
</body>

</html>
