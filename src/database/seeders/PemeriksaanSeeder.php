<?php

namespace Database\Seeders;

use App\Models\Pemeriksaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemeriksaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pemeriksaan::create([
        'pendaftaran_id' => 1,
        'dokter_id' => 1,
        'tekanan_darah' => '120/80',
        'berat_badan' => 60,
        'tinggi_badan' => 170,
        'suhu_tubuh' => 37,
        'catatan' => 'Pasien mengalami flu ringan',
    ]);
    }
}
