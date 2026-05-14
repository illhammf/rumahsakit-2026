<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $guarded = ['id'];

    public function detailReseps()
    {
        return $this->hasMany(DetailResep::class);
    }
}

