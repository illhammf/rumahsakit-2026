<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $guarded = ['id']; // Mengizinkan mass assignment untuk semua atribut kecuali 'id'

    public function jadwalDokters()
    {
        return $this->hasMany(JadwalDokter::class); // Relasi one-to-many dengan model JadwalDokter
    }

    public function pemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::class); // Relasi one-to-many dengan model Pemeriksaan
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class); // Relasi one-to-many dengan model RekamMedis
    }
}
