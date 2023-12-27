@php
    // Import namespace di luar blok PHP
    use Illuminate\Support\Facades\File;

    // Lanjutkan dengan penggunaan normal
    if ($notaDinasPelaksanaan->tanda_tangan_user_pelaksanaan) {
        $imagePath = public_path('storage/' . $notaDinasPelaksanaan->tanda_tangan_user_pelaksanaan);
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
    <title>NOTA DINAS - PERMINTAAN PELAKSANAAN PENGADAAN</title>
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
    <div style="float: right;">
        <img src="data:image/{{ $types }};base64,{{ $base64Image }}" alt="Logo" width="120">
    </div>
    <h4 style="text-align: right; width: 100%;"><b>NOTA DINAS - PERMINTAAN PELAKSANAAN PENGADAAN</b></h4>
    <p style="text-align: center;"><b>Nomor : {{ $notaDinasPelaksanaan->Nomor_ND_Lakdan }}</b></p>
    <hr />
    <br>
    <div>
        <br>
        <P>Kepada Yth. &nbsp;: <b>Pejabat Pelaksanaan Pengadaan</b></P>
        <P>Dari &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>Pengguna Barang/Jasa</b></P>
        <P>Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>{{ $tanggalFormatted }}</b></P>
        <P>Perihal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>Permintaan Pelaksanaan Pengadaan</b></P>
        <p style="color: #800000"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $pengadaan->Judul_Pengadaan }}</b></p>
        <br>
        <br>
        <p>Dengan Hormat,</p>
        <p>Sesuai dengan kebutuhan pada {{ $notaDinasPelaksanaan->divisi_pengguna }}, kami ingin mengajukan permintaan pelaksanaan pengadaan barang/jasa dengan detail sebagai berikut:</p>
        <p>&nbsp;<center><b>INFORMASI PEKERJAAN DAN ANGGARAN</b></center>&nbsp;</p>
        <br>
        <br>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;Nama Pekerjaan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>{{ $pengadaan->Judul_Pengadaan }}</b></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;Jenis Pengadaan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>{{ $jenisPengadaan->Jenis_Pengadaan }}</b></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;Ringkasan Pekerjaan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>{{ $pengadaan->Ringkasan_Pekerjaan }}</b></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;Nama Pengguna&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>{{ $notaDinasPelaksanaan->nama_pengguna }}</b></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;Divisi Pengguna&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>{{ $notaDinasPelaksanaan->divisi_pengguna }}</b></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;Informasi Anggaran (Nomor PRK)    : <b>{{ $notaDinasPelaksanaan->Nomor_PRK }}</b></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;Sumber Anggaran&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>{{ $sumberAnggaran->nama_anggaran }}</b></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;Cost Center&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>{{ $notaDinasPelaksanaan->cost_center }}</b></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;Pagu Anggaran&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>{{ $notaDinasPelaksanaan->pagu_anggaran }}</b></p>
        @if ($rencanaMulaiFormatted && $rencanaSelesaiFormatted)
        <p>&nbsp;&nbsp;&nbsp;&nbsp;Rencana Tanggal Terkontrak&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>{{ $rencanaMulaiFormatted }} - {{ $rencanaSelesaiFormatted }}</b></p>
        @endif
        @if ($pengadaan->rencana_durasi_kontrak && $pengadaan->rencana_durasi_kontrak_tanggal)
        <p>&nbsp;&nbsp;&nbsp;&nbsp;Rencan Durasi Kontrak&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>{{ $pengadaan->rencana_durasi_kontrak }} {{ $pengadaan->rencana_durasi_kontrak_tanggal }}</b></p>
        @endif
        @if ($notaDinasPelaksanaan->url_kak)
        <p>&nbsp;&nbsp;&nbsp;&nbsp;URL KAK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>{{ $notaDinasPelaksanaan->url_kak }}</b></p>
        @endif
        @if ($notaDinasPelaksanaan->url_spesifikasi_teknis)
        <p>&nbsp;&nbsp;&nbsp;&nbsp;URL Spesifikasi Teknis&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>{{ $notaDinasPelaksanaan->url_spesifikasi_teknis }}</b></p>
        @endif
        <p></p>
        <p>Dengan ini, kami mohon dukungan dari tim pelaksana pengadaan untuk menyiapkan dokumen yang dibutuhkan untuk dapat melaksanakan proses pengadaan barang/jasa sesuai dengan informasi yang tertera di atas.</p>
        <p>Demikian disampaikan, atas perhatiannya diucapkan terima kasih.</p>
    <p></p>
    <br>

    <div style="float: right;">
        <p>@if(isset($kota))
            {{ $kota->Kota }},
        @endif{{ $tanggalFormatted }}</p>
        <p>Disetujui oleh:</p>
        <p></p>
        <p><b>Pengguna Barang/Jasa</b></p>
        <div>
            @if ($notaDinasPelaksanaan->tanda_tangan_user_pelaksanaan)
                <img src="data:image/{{ $imageMimeType }};base64,{{ $imageData }}" alt="Tanda Tangan" width="100">
            @else
                <p></p>
            @endif
        </div>
        <br>
        <p><b><u>{{ $notaDinasPelaksanaan->nama_user_1 }}</u></b></p>
        {{-- <hr /> --}}
        <p><b>{{ $notaDinasPelaksanaan->jabatan_user_1 }}</b></p>
    </div>
</body>

</html>
