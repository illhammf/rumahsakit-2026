<?php

namespace Database\Seeders;

use App\Models\JadwalDokter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalDokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        JadwalDokter::create([
            'dokter_id' => 1,
            'poli_id' => 1,
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '12:00',
        ]);

        JadwalDokter::create([
            'dokter_id' => 2,
            'poli_id' => 2,
            'hari' => 'Selasa',
            'jam_mulai' => '09:00',
            'jam_selesai' => '13:00',
        ]);
    }
}
