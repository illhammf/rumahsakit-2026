<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Pasien::create([
        'nama' => 'Budi Santoso',
        'nik' => '3201010101010001',
        'jenis_kelamin' => 'L',
        'tanggal_lahir' => '2000-05-10',
        'alamat' => 'Tangerang',
        'no_telepon' => '081234567890',
        'email' => 'budi@gmail.com',
        'golongan_darah' => 'O',
        ]);

        Pasien::create([
            'nama' => 'Siti Aisyah',
            'nik' => '3201010101010002',
            'jenis_kelamin' => 'P',
            'tanggal_lahir' => '2001-08-21',
            'alamat' => 'Jakarta',
            'no_telepon' => '081298765432',
            'email' => 'siti@gmail.com',
            'golongan_darah' => 'A',
        ]);
    }
}
