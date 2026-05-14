<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PasienSeeder::class,
            DokterSeeder::class,
            PoliSeeder::class,
            JadwalDokterSeeder::class,
            PendaftaranSeeder::class,
            PemeriksaanSeeder::class,
            RekamMedisSeeder::class,
            ObatSeeder::class,
            ResepSeeder::class,
            DetailResepSeeder::class,
            PembayaranSeeder::class,
        ]);
    }
}
