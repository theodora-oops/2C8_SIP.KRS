<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'tahun_ajaran',
        'tipe',
        'is_active'
    ];

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }
}