<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $guarded = ['id']; // Mengizinkan mass assignment untuk semua atribut kecuali 'id'

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class); // Relasi one-to-many dengan model Pendaftaran
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class); // Relasi one-to-many dengan model RekamMedis
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class); // Relasi one-to-many dengan model Pembayaran
    }
}
