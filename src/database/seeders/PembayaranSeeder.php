<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pembayaran::create([
            'pasien_id' => 1,
            'pendaftaran_id' => 1,
            'metode_pembayaran' => 'Cash',
            'total_bayar' => 150000,
            'status_pembayaran' => 'Lunas',
            'tanggal_pembayaran' => now(),
        ]);
    }
}
