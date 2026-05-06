<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Krs;

class Matkul extends Model
{
    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
        'dosen_id'
    ];

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    public function krs(): HasMany
    {
        return $this->hasMany(Krs::class, 'matkul_id');
    }
}