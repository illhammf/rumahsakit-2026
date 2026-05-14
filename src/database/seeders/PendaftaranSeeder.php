<?php

namespace Database\Seeders;

use App\Models\Pendaftaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Pendaftaran::create([
            'pasien_id' => 1,
            'jadwal_dokter_id' => 1,
            'tanggal_daftar' => now(),
            'keluhan' => 'Demam dan batuk',
            'status' => 'Menunggu',
        ]);

        Pendaftaran::create([
            'pasien_id' => 2,
            'jadwal_dokter_id' => 2,
            'tanggal_daftar' => now(),
            'keluhan' => 'Sakit kepala',
            'status' => 'Diproses',
        ]);
    }
}
