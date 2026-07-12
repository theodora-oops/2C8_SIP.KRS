<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $fillable = [
        'user_id',
        'nomor_induk',
        'nama',
        'foto',
        'no_hp',
        'alamat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function matkuls()
    {
    return $this->hasMany(Matkul::class);
    }
}
