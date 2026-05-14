<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    protected $guarded = ['id']; // Mengizinkan mass assignment untuk semua atribut kecuali 'id'

    public function dokter()
    {
        return $this->belongsTo(Dokter::class); // Relasi many-to-one dengan model Dokter
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class); // Relasi many-to-one dengan model Poli
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class); // Relasi one-to-many dengan model Pendaftaran
    }
}
