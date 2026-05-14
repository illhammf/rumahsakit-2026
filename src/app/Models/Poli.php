<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $guarded = ['id']; // Mengizinkan mass assignment untuk semua atribut kecuali 'id'

    public function jadwalDokters()
    {
        return $this->hasMany(JadwalDokter::class); // Relasi one-to-many dengan model JadwalDokter
    }
}
