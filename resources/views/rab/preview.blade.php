@php
    // Import namespace di luar blok PHP
    use Illuminate\Support\Facades\File;

    // Lanjutkan dengan penggunaan normal
    if ($rab->tanda_tangan_user_1) {
        $imagePath = public_path('storage/' . $rab->tanda_tangan_user_1);
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
    <title>Rencana Anggaran Biaya</title>
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
    <div>
        <p><b><i>Rahasia</i></b></p>
        <br>
        <div style="float: right; margin-right: 20px;">
         <p>@if(isset($kota))
        {{ $kota->Kota }},
    @endif {{ $tanggalFormatted }}</p>
        </div>
        <p></p>
        <br>
        <h4><center>RENCANA ANGGARAN BIAYA (RAB)</center></h4>
        <center>PENGADAAN LANGSUNG BARANG/JASA</center>

        <h3><center>{{ $pengadaan->Judul_Pengadaan }}</center></h3>

        <p>Berikut terlampir usulan Rencana Anggaran Biaya (RAB) untuk Pengadaan Langsung tersebut di atas, yakni senilai:</p>

        <table border="1" cellpadding="2">
            <thead>
                <tr>
                    {{-- <th>&nbsp;Kode Barang&nbsp;</th> --}}
                    <th>&nbsp;Nama Barang&nbsp;</th>
                    <th>&nbsp;Estimasi Jumlah&nbsp;</th>
                    <th>&nbsp;Unit&nbsp;</th>
                    {{-- <th>&nbsp;ID Transaksi&nbsp;</th> --}}
                    <th>&nbsp;Deskripsi&nbsp;</th>
                    <th>&nbsp;Keterangan&nbsp;</th>
                    <th>&nbsp;Harga (Rp.)&nbsp;</th>
                    <th>&nbsp;Total (Rp.)&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangs as $barang)
                <tr>
                    {{-- <td><center>{{ $barang->Kode_Barang }}</center></td> --}}
                    <td><center>{{ $barang->Nama_Barang }}</center></td>
                    <td><center>{{ $barang->estimasi_jumlah }}</center></td>
                    <td><center>{{ $barang->Unit }}</center></td>
                    {{-- <td><center>{{ $barang->transaksi->ID_Transaksi }}</center></td> --}}
                    <td><center>{{ $barang->Deskripsi }}</center></td>
                    <td><center>{{ $barang->Keterangan }}</center></td>
                    <td><center>{{ $barang->Harga }}</center></td>
                    <td><center>{{ $barang->Total }}</center></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table border="2">
            <tbody>
            <tr>
                <td><center>Total Keseluruhan:</center></td>
                <td><center>Rp.&nbsp;{{ $rab->total_keseluruhan }}&nbsp;</center></td>
            </tr>
        </tbody>
        </table>
    </div>
    <p></p>
    <br>
    <br>

    <div>
        <p>@if(isset($kota))
            {{ $kota->Kota }},
        @endif{{ $tanggalFormatted }}</p>
        <p>Disetujui oleh:</p>
        <p></p>
        <div>
            @if ($rab->tanda_tangan_user_1)
                <img src="data:image/{{ $imageMimeType }};base64,{{ $imageData }}" alt="Tanda Tangan" width="100">
            @else
                <p></p>
            @endif
        </div>
        <br>
        <p>Pengguna Barang/Jasa: <b>{{ $rab->nama_user_1 }}</b></p>
        <p>Jabatan: <b>{{ $rab->jabatan_user_1 }}</b></p>
        <p>Lampiran: Rincian RAB</p>
    </div>
</body>

</html>
