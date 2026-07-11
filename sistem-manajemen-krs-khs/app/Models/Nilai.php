<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = [
        'krs_id',
        'nilai',
        'tugas',
        'uts',
        'uas',
    ];

    public function krs()
    {
        return $this->belongsTo(Krs::class);
    }
}