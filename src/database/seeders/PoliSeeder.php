<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Poli::create([
            'nama_poli' => 'Poli Umum',
            'deskripsi' => 'Pelayanan umum',
        ]);

        Poli::create([
            'nama_poli' => 'Poli Anak',
            'deskripsi' => 'Pelayanan anak',
        ]);
    }
}
