<!DOCTYPE html>
<html>
<head>
    <title>Laporan PDF</title>
</head>
<body>
    <h1>Data Pengadaan Barang/Jasa</h1>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tujuan</th>
                <!-- Tambahkan kolom lain sesuai kebutuhan -->
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $pengadaanScm['nama_pekerjaan'] }}</td>
                <td>{{ $pengadaanScm['tujuan'] }}</td>
                <!-- Tambahkan baris lain sesuai kebutuhan -->
            </tr>
        </tbody>
    </table>
</body>
</html>
