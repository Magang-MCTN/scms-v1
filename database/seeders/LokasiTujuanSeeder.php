<?php

namespace Database\Seeders;

use App\Models\LokasiTujuan;
use Illuminate\Database\Seeder;

class LokasiTujuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LokasiTujuan::create(['nama_lokasi' => 'Kantor MCTN Jakarta']);
        LokasiTujuan::create(['nama_lokasi' => 'Kantor MCTN Pekanbaru']);
        LokasiTujuan::create(['nama_lokasi' => 'Ladang Minyak Duri MCTN']);
    }
}
