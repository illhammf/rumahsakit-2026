<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $guarded = ['id'];

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class);
    }

    public function detailReseps()
    {
        return $this->hasMany(DetailResep::class);
    }
}
