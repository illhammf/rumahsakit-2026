<?php

namespace Database\Seeders;

use App\Models\Dokter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dokter::create([
            'nama' => 'Dr. Andi Saputra',
            'spesialis' => 'Umum',
            'email' => 'andi@rs.com',
            'no_telepon' => '081111111111',
            'alamat' => 'Tangerang',
        ]);

        Dokter::create([
            'nama' => 'Dr. Dewi Lestari',
            'spesialis' => 'Anak',
            'email' => 'dewi@rs.com',
            'no_telepon' => '082222222222',
            'alamat' => 'Jakarta',
        ]);
    }
}
