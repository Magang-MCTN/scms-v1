<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['nama_role' => 'administrator', 'keterangan_role' => 'Administrator']);
        Role::create(['nama_role' => 'admin_jkt', 'keterangan_role' => 'Admin Jakarta']);
        Role::create(['nama_role' => 'tuan_rumah', 'keterangan_role' => 'Tuan Rumah']);
        Role::create(['nama_role' => 'phr', 'keterangan_role' => 'PHR']);
        Role::create(['nama_role' => 'admin_duri', 'keterangan_role' => 'Admin Duri']);
        Role::create(['nama_role' => 'security', 'keterangan_role' => 'Security']);
        Role::create(['nama_role' => 'admin_pku', 'keterangan_role' => 'Admin Pekanbaru']);
    }
}
