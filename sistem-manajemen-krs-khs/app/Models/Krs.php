<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $fillable = ['user_id','matkul_id', 'nilai'];

    public function matkul()
    {
        return $this->belongsTo(\App\Models\Matkul::class);
    }
}
