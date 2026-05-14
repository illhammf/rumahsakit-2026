<?php

namespace Database\Seeders;

use App\Models\RekamMedis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RekamMedisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RekamMedis::create([
        'pasien_id' => 1,
        'dokter_id' => 1,
        'pemeriksaan_id' => 1,
        'diagnosa' => 'Influenza',
        'tindakan' => 'Pemberian obat dan istirahat',
        'catatan' => 'Kontrol kembali jika belum membaik',
        ]);
    }
}

