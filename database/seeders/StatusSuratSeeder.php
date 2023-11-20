<?php

namespace Database\Seeders;

use App\Models\StatusSurat;
use Illuminate\Database\Seeder;

class StatusSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusSurat::create(['nama_status_surat' => 'Menunggu Persetujuan']);
        StatusSurat::create(['nama_status_surat' => 'Disetujui']);
        StatusSurat::create(['nama_status_surat' => 'Ditolak']);
        StatusSurat::create(['nama_status_surat' => 'Menunggu Persetujuan PHR']);
        StatusSurat::create(['nama_status_surat' => 'Ditolak PHR']);
        StatusSurat::create(['nama_status_surat' => 'Menunggu Persetujuan Admin']);
        StatusSurat::create(['nama_status_surat' => 'Ditolak Admin']);
    }
}
