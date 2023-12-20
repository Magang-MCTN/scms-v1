@php
    // Import namespace di luar blok PHP
    use Illuminate\Support\Facades\File;

    // Lanjutkan dengan penggunaan normal
    if ($rks->tanda_tangan_user_1) {
        $imagePath = public_path('storage/' . $rks->tanda_tangan_user_1);
        $imageData = base64_encode(File::get($imagePath));
        $imageMimeType = mime_content_type($imagePath);
    }

    if ($rks->tanda_tangan_rendan_1) {
        $imagePathRendan = public_path('storage/' . $rks->tanda_tangan_rendan_1);
        $imageDataRendan = base64_encode(File::get($imagePathRendan));
        $imageMimeTypeRendan = mime_content_type($imagePathRendan);
    }
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RINGKASAN RKS</title>
</head>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    /* Make the thead horizontal */
    th {
        white-space: nowrap;
        display: block;
    }

    th::after {
        content: '\00a0'; /* Non-breaking space */
        white-space: pre;
    }

    @media (max-width: 768px) {
  table.horizontal-table {
    float: none;
    width: 100%;
  }
}
</style>

<body>
    <div style="float: left; margin-right: 20px;">
        <img src="data:image/{{ $types }};base64,{{ $base64Image }}" alt="Logo" width="250">
    </div>
    <p></p>
    <p></p>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div id="content">
        <p><b><i>Rahasia</i></b></p>
        <br>
        <div style="float: right; margin-right: 20px;">
         <p>@if(isset($kota))
        {{ $kota->Kota }},
    @endif {{ $tanggalFormatted }}</p>
        </div>
        <p></p>
        <br>
        <h4><center>RINGKASAN RKS</center></h4>
        <table border="1" cellpadding="2" class="horizontal-table">
            <tbody class="info-table">
                <tr>
                    <tr>
                        <th>&nbsp; Status RKS/Pekerjaan &nbsp;</th>
                        <td><center>{{ $rks->Status_Rks }}</center></td>
                    </tr>
                    <tr>
                        <th>&nbsp; Judul RKS &nbsp;</th>
                        <td><center>{{ $pengadaan->Judul_Pengadaan }}</center></td>
                    </tr>
                    <tr>
                        <th>&nbsp; Ringkasan Pekerjaan &nbsp;</th>
                        <td><center>{{ $pengadaan->Ringkasan_Pekerjaan }}</center></td>
                    </tr>
                    <tr>
                        <th>&nbsp; Pengguna Barang/Jasa &nbsp;</th>
                        <td><center>{{ $notaDinasPermintaan->jabatan_user_1 }}</center></td>
                    </tr>
                    <tr>
                        <th>&nbsp; Kualifikasi CSMS &nbsp;</th>
                        <td><center>{{ $rks->Kualifikasi_CSMS }}</center></td>
                    </tr>
                    <tr>
                        <th>&nbsp; Rencana Tanggal Terkontrak &nbsp;</th>
                        <td>
                            <center>
                                @if ($rencanaMulaiFormatted && $rencanaSelesaiFormatted)
                                    {{ $rencanaMulaiFormatted }} - {{ $rencanaSelesaiFormatted }}
                                @endif
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <th>&nbsp; Rencana Durasi Kontrak &nbsp;</th>
                        <td>
                            <center>
                                @if ($pengadaan->rencana_durasi_kontrak && $pengadaan->rencana_durasi_kontrak_tanggal)
                                    {{ $pengadaan->rencana_durasi_kontrak }} {{ $pengadaan->rencana_durasi_kontrak_tanggal }}
                                @endif
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <th>&nbsp; Target Selesai RKS &nbsp;</th>
                            <td><center>{{ $rks->Target_Selesai_Rks }}</center></td>
                    </tr>
                    <tr>
                        <th>&nbsp; Sumber Anggaran  &nbsp;</th>
                        <td><center>{{ $sumberAnggaran->nama_anggaran }}</center></td>
                    </tr>
                        <tr>
                            <th>&nbsp; Nomor PRK &nbsp;</th>
                            <td><center>{{ $notaDinasPermintaan->Nomor_PRK }}</center></td>
                        </tr>
                            <tr>
                                <th>&nbsp; Cost Center &nbsp;</th>
                                <td><center>{{ $notaDinasPermintaan->cost_center }}</center></td>
                            </tr>
                                <tr>
                                    <th>&nbsp; Nilai HPE &nbsp;</th>
                                    <td><center>{{ $hpe->HPE }}</center></td>
                                </tr>
                                    <tr>
                                        <th>&nbsp; Jenis Pengadaan &nbsp;</th>
                                        <td><center>{{ $jenisPengadaan->Jenis_Pengadaan }}</center></td>
                                    </tr>
                                        <tr>
                                            <th>&nbsp; Metode Pengadaan &nbsp;</th>
                                            <td><center>{{ $metodePengadaan->Metode_Pengadaan }}</center></td>
                                        </tr>
                                            <tr>
                                                <th>&nbsp; Metode Penawaran &nbsp;</th>
                                                <td><center>{{ $metodePenawaran->Metode_Penawaran }}</center><br><p style="font-size: 13px">Keterangan: 

                        <p style="font-size: 13px">Sistem 1 tahap 1 sampul: Penawaran Teknis dan Komersial akan dibuka pada saat yang sama, dan kemudian dievaluasi.</p> 
                        
                        <p style="font-size: 13px">Sistem 1 tahap 2 sampul: Penawaran Teknis harus dibuka terlebih dahulu. Penawaran Komersial harus dibuka bagi mereka yang telah lulus evaluasi teknis.</p>
                        
                        <p style="font-size: 13px">Sistem 2 tahap: Penawaran Teknis harus diajukan dan dibuka terlebih dahulu untuk klarifikasi dan evaluasi lebih lanjut.Penawaran Komersial harus diajukan dan dibuka bagi mereka yang telah lulus evaluasi teknis.</p></td>
                    </tr>
                    <tr>
                        <th>&nbsp; Kualifikasi Pengadaan &nbsp;</th>
                        <td><center>{{ $rks->Kualifikasi_Pengadaan }}</center></td>
                    </tr>
                    <tr>
                        <th>&nbsp; Metode Evaluasi Penawaran &nbsp;</th>
                        <td><center>{{ $metodeEvaluasiPenawaran->Metode_Evaluasi_Penawaran }}</center></td>
                    </tr>
                    <tr>
                        <th>&nbsp; Info Tambahan (Jika ada) &nbsp;</th>
                        <td><center>{{ $rks->Info_Tambahan }}</center></td>
                    </tr>
                </tr>
            </tbody>
        </table>
    </div>
    <p></p>
    <br>
    {{-- <div style="display: flex; justify-content: space-between; align-items: flex-start;"> --}}
        <div>
            <p>
                @if(isset($kota))
                    {{ $kota->Kota }},
                @endif{{ $tanggalFormatted }}
            </p>
            <p>Disusun oleh:</p>
            <p>Pejabat Perencana Pengadaan</p>
            <p></p>
            <div>
                @if ($rks->tanda_tangan_rendan_1)
                    <img src="data:image/{{ $imageMimeTypeRendan }};base64,{{ $imageDataRendan }}" alt="Tanda Tangan" width="100">
                @else
                    <p></p>
                @endif
            </div>
            <p>Pengguna Barang/Jasa: <b>{{ $rks->nama_rendan_1 }}</b></p>
            <p>Jabatan: <b>{{ $hpe->jabatan_pejabat_rendan }}</b></p>
        </div>
        <br>
        <p></p>
        <div style="margin-right: 20px;">
            <p>Disetujui oleh:</p>
            <p>Pengguna Barang/Jasa:</p>
            <p></p>
            <div>
                @if ($rks->tanda_tangan_user_1)
                    <img src="data:image/{{ $imageMimeType }};base64,{{ $imageData }}" alt="Tanda Tangan" width="100">
                @else
                    <p></p>
                @endif
            </div>
            <p>Pengguna Barang/Jasa: <b>{{ $rks->nama_user_1 }}</b></p>
            <p>Jabatan: <b>{{ $notaDinasPermintaan->jabatan_user_1 }}</b></p>
        </div>
    {{-- </div> --}}
    
</body>

</html>
