<?php

namespace Database\Seeders;

use App\Models\DetailResep;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailResepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailResep::create([
            'resep_id' => 1,
            'obat_id' => 1,
            'jumlah' => 10,
            'dosis' => '3x1',
            'aturan_pakai' => 'Sesudah makan',
        ]);
    }
}
